<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type', 'admin')->get();
        return view('back.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $v_data = [
            'last_name' => 'required|max:255',
            'designation' => 'required|max:255',
            'mobile_number' => 'required|max:255|unique:users',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ];
        if($request->file('profile')){
            $v_data['profile'] = 'mimes:jpg,png,jpeg,gif';
        }

        $request->validate($v_data);

        $data = $request->except('password','profile');
        $data +=[
            'type'=>'admin',
            'password' => Hash::make($request->password),
        ];
        if($request->file('profile')){
            $image = $request->file('profile');
            $filename    = time() . '.' . $image->getClientOriginalExtension();

            // Resize Image 150*150

            // File::makeDirectory(public_path() . '/uploads/user', $mode = 0775, true, true);
            $image_resize = Image::make($image->getRealPath());
            $image_resize->fit(150, 150);
            $image_resize->encode($image->getClientOriginalExtension());
            Storage::disk(env('FILE_DISK'))->put('/uploads/user/' . $filename,(string)$image_resize);

            // $image_resize = Image::make($image->getRealPath());
            // $image_resize->fit(150, 150);
            // $image_resize->save(public_path('/uploads/user/' . $filename));
            $data +=[
                'profile_image'=>$filename,
            ];
        }
        try {
            User::create($data);
            return redirect()->back()->with('success-alert', 'Admin created successfully.');
        }catch (\Exception $e){
            return redirect()->back()->with('error-alert', 'Invalid request.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // dd($user);
        return view('back.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $v_data = [
            'last_name' => 'required|max:255',
            'mobile_number' => 'required|max:255|unique:users,mobile_number,' . $id,
            'email' => 'required|max:255|unique:users,email,' . $id,
        ];
        $data = $request->only('last_name','mobile_number','email');

        if($request->file('profile')){
            $v_data['profile'] = 'mimes:jpg,png,jpeg,gif';
        }
        if($request->password){
            $v_data['password'] = 'min:8|confirmed';
        }

        $request->validate($v_data);

        $user = User::findOrFail($id);

        if($request->password){
            $data +=[
                'password' => Hash::make($request->password),
            ];
        }

        if($request->file('profile')){
            $image = $request->file('profile');
            $filename    = time() . '.' . $image->getClientOriginalExtension();

            // Resize Image 150*150
            // File::makeDirectory(public_path() . '/uploads/user', $mode = 0775, true, true);
            $image_resize = Image::make($image->getRealPath());
            $image_resize->fit(150, 150);
            $image_resize->encode($image->getClientOriginalExtension());
            Storage::disk(env('FILE_DISK'))->put('/uploads/user/' . $filename,(string)$image_resize);



            // Delete old
            if($user->profile){
                $img = '/uploads/user/' . $user->profile;
                if(Storage::disk(env('FILE_DISK'))->exists($img)){
                    Storage::disk(env('FILE_DISK'))->delete($img);
                }
            }
            $data +=[
                'profile_image'=>$filename,
            ];
        }

        try {
            $user->update($data);
            return redirect()->back()->with('success-alert', 'Admin updated successfully.');
        }catch (\Exception $e){
            return redirect()->back()->with('error-alert', 'Invalid request.');
        }
    }

    public function update_profile_page(){
        $user = User::where('id', Auth::user()->id)->first();
        return view('back.admin.edit-admin')->with('user', $user);
    }

    public function update_profile(Request $request){
        $v_data = [
            'last_name' => 'required|max:255',
            'mobile_number' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,'.auth()->id(),
        ];
        if($request->file('profile')){
            $v_data['profile'] = 'mimes:jpg,png,jpeg,gif';
        }
        $request->validate($v_data);

        $data = $request->only('last_name','mobile_number','email');

        $user = User::findOrFail(Auth::user()->id);

        if($request->file('profile')){
            $image = $request->file('profile');
            $filename    = time() . '.' . $image->getClientOriginalExtension();

            // Resize Image 150*150
            $image_resize = Image::make($image->getRealPath());
            $image_resize->fit(150, 150);
            $image_resize->encode($image->getClientOriginalExtension());
            Storage::disk(env('FILE_DISK'))->put('/uploads/user/' . $filename,(string)$image_resize);



            if($user->profile){
                $img = '/uploads/user/' . $user->profile;
                if(Storage::disk(env('FILE_DISK'))->exists($img)){
                    Storage::disk(env('FILE_DISK'))->delete($img);
                }
            }

            $data +=[
                'profile_image'=>$filename,
            ];
        }
        try {
            $user->update($data);
            return redirect()->back()->with('success-alert', 'Profile updated successfully.');
        }catch (\Exception $e){
            return redirect()->back()->with('error-alert', 'Invalid request.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user->id == auth()->user()->id){
            return redirect()->back()->with('error-alert', 'Sorry! You can not delete your own account!');
        }

        // Delete Image
        if($user->profile){
            $img = '/uploads/user/' . $user->profile;
            if(Storage::disk(env('FILE_DISK'))->exists($img)){
                Storage::disk(env('FILE_DISK'))->delete($img);
            }
        }

        $user->delete();

        return redirect()->route('back.admins.index')->with('success-alert', 'Admin deleted successfully.');
    }

    public function update_password(Request $request) {
        $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('id', Auth::user()->id)->first();

        if(Hash::check($request->old_password, auth()->user()->password)){
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success-alert', 'Password updated successfully.');
        }
        return redirect()->back()->with('error-alert', 'Old password dose not match!');
    }

    public function removeImage(User $user){
        if($user->profile){
            $img = '/uploads/user/' . $user->profile;
            if(Storage::disk(env('FILE_DISK'))->exists($img)){
                Storage::disk(env('FILE_DISK'))->delete($img);
            }
            $user->profile = null;
            $user->save();
        }

        return redirect()->back()->with('success-alert', 'Admin images deleted successfully.');
    }
}
