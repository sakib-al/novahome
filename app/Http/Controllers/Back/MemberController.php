<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\MemberType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type', 'member')->latest('id')->get();

        return view('back.members.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $member_types =MemberType::all();
        return view('back.members.create',compact('member_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'last_name' => 'required|max:255',
            'email' => 'required|unique:users|max:191',
            'password' => 'required|min:6|confirmed',
            'member_type_id'=>'required|not_in:0|exists:member_types,id'
            //'mobile_number' => 'max:255',
            //'gender' => 'max:255',
            //'street' => 'max:255',
            //'city' => 'max:255',
            //'state' => 'max:255',
            //'post_code' => 'max:255',
            //'country' => 'max:255'
        ]);
        $data = $request->only(['last_name','email','member_type_id']);

        $member_type=MemberType::find($request->member_type_id);
        $att = json_decode($member_type->attributes,true);

        /* splitting normal dynamic input or image or file */
        $normal=[];
        $images=[];
        $files=[];
        foreach ($att as $at){
            if ($at['input_type']=='image'){
                $images []=$at['input_name'];
            }else if($at['input_type']=='file'){
                $files []=$at['input_name'];
            }else{
                $normal []=$at['input_name'];
            }
        }
        $info=$request->only($normal);
        $info +=[
            'amount'=>$request->amount,
        ];
        foreach ($images as $image){
            if ($request->file($image)){
                $file = $request->file($image);
                $photo = time() . '.' . $file->getClientOriginalExtension();
                $destination ='/uploads/user/doc';
                $file->storeAs(
                    $destination,
                    $photo,
                    env('FILE_DISK')
                );
                // $file->move($destination, $photo);
                $info +=[
                    $image=>'/uploads/user/doc/'.$photo
                ];
            }
        }
        foreach ($files as $fl){
            if ($request->file($fl)) {
                $file = $request->file($fl);
                $fileName = time().'_'.$request->file($fl)->getClientOriginalName();

                $destination = 'uploads/user/doc';
                $file->storeAs(
                    $destination,
                    $fileName,
                    env('FILE_DISK')
                );
                // $file->move($destination, $fileName);
                $info +=[
                    $fl=>'/uploads/user/doc/'.$fileName
                ];
            }
        }
        // Insert Profile Image
        $img=null;
        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $photo = time() . '.' . $file->getClientOriginalExtension();
            $destination = '/uploads/user';
            $file->storeAs(
                $destination,
                $photo,
                env('FILE_DISK')
            );
            // $file->move($destination, $photo);
            $img = $photo;
        }

        $data +=[
            'password'=>Hash::make($request->password),
            'profile_image'=>$img,
            'status'=>'approved',
            'info'=>json_encode($info),
            'payment_status'=>'paid',
        ];
        User::create($data);

        return redirect()->back()->with('success-alert', 'Member created successfully.');
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
        $member_types=MemberType::all();
        return view('back.members.edit', compact('user','member_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'last_name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$id,
            //'password' => 'required|min:6|confirmed',
            'member_type_id'=>'required|not_in:0|exists:member_types,id'
            //'mobile_number' => 'max:255',
            //'gender' => 'max:255',
            //'street' => 'max:255',
            //'city' => 'max:255',
            //'state' => 'max:255',
            //'post_code' => 'max:255',
            //'country' => 'max:255'
        ]);
        $data = $request->only(['last_name','email','member_type_id']);

        $member_type=MemberType::find($request->member_type_id);
        $att = json_decode($member_type->attributes,true);
        /* splitting normal dynamic input or image or file */
        $normal=[];
        $images=[];
        $files=[];
        foreach ($att as $at){
            if ($at['input_type']=='image'){
                $images []=$at['input_name'];
            }else if($at['input_type']=='file'){
                $files []=$at['input_name'];
            }else{
                $normal []=$at['input_name'];
            }
        }
        $info_before=json_decode($user->info,true);
        $info =$request->only($normal);
        $info +=[
            'amount'=>$request->amount,
        ];
        foreach ($images as $image){
            if ($request->file($image)){
                $file = $request->file($image);
                $photo = time() . '.' . $file->getClientOriginalExtension();
                $destination = '/uploads/user/doc';
                $file->storeAs(
                    $destination,
                    $photo,
                    env('FILE_DISK')
                );
                // $file->move($destination, $photo);
                $info +=[
                    $image=>'/uploads/user/doc/'.$photo
                ];
            }else{
                $info +=[
                    $image=>$info_before[$image]
                ];
            }
        }
        foreach ($files as $fl){
            if ($request->file($fl)) {
                $file = $request->file($fl);
                $fileName = time().'_'.$request->file($fl)->getClientOriginalName();

                $destination = 'uploads/user/doc';
                $file->storeAs(
                    $destination,
                    $fileName,
                    env('FILE_DISK')
                );
                // $file->move($destination, $fileName);
                $info +=[
                    $fl=>'/uploads/user/doc/'.$fileName
                ];
            }else{
                $info +=[
                    $fl=>$info_before[$fl]
                ];
            }
        }
        $img=null;
        // Insert Profile Image
        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $photo = time() . '.' . $file->getClientOriginalExtension();
            $destination = '/uploads/user';
            $file->storeAs(
                $destination,
                $photo,
                env('FILE_DISK')
            );
            // $file->move($destination, $photo);

            $img = $photo;
            if($user->profile){
                // $img2 = public_path() . '/uploads/user/' . $user->profile;
                $img_del = '/uploads/user/' . $user->profile;
                if(Storage::disk(env('FILE_DISK'))->exists($img_del)){

                    Storage::disk(env('FILE_DISK'))->delete($img_del);
                }
                // if (file_exists($img2)) {
                //     unlink($img2);
                // }
            }
        }

        $data +=[
            'profile_image'=>$img,
            'info'=>json_encode($info)
        ];
        $user->update($data);
        return redirect()->back()->with('success-alert', 'Member updated successfully.');
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
        $user->delete();

        return redirect()->route('back.members.index')->with('success-alert', 'Member deleted successfully.');
    }

    public function removeImage(User $user){
        // Delete Old
        if($user->profile_image){
            $img ='/uploads/user/' . $user->profile_image;
            if(Storage::disk(env('FILE_DISK'))->exists($img)){

                Storage::disk(env('FILE_DISK'))->delete($img);
            }

            $user->profile_image = null;
            $user->save();
        }

        return redirect()->back()->with('success-alert', 'Member images deleted successfully.');
    }

    public function memberProfile(User $user)
    {
        return view('back.members.memberProfile',compact('user'));
    }
}
