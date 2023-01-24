<?php

namespace App\Http\Controllers;

use App\Http\Middleware\MembershipMiddleware;
use App\Models\Donation;
use App\Models\EventJoin;
use App\Models\MemberType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Stripe;
use Illuminate\Support\Facades\Storage;
class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(MembershipMiddleware::class)->except('form', 'formSubmit', 'memberDashboard','memberPaymentPage','memberPaymentStore');
        parent::__construct();
    }

    // Form
    public function form(){
        if(auth()->user()->status != 'before_submit'){
            return redirect()->route('memberDashboard')->with('error-alert2', 'Sorry! Your membership form already submitted.');
        }
        $member_types=MemberType::where(['status'=>1])->get();
        return view('front.member.form',compact('member_types'));
    }
    public function formSubmit(Request $request){
        $user = User::findOrFail(auth()->user()->id);
        if($user->status != 'before_submit'){
            return redirect()->route('memberDashboard')->with('error-alert2', 'Sorry! Your membership form already submitted.');
        }

        $request->validate([
            'profile_image' => 'required',
            'last_name' => 'required|max:255',
            'member_type_id' => 'required',
        ]);
        //dd($request->all());

        // Insert Profile Image
        $p_img=null;
        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $photo = time() . '.' . $file->getClientOriginalExtension();
            $destination = '/uploads/user';
            $file->storeAs(
                $destination,
                $photo,
                env('FILE_DISK')
            );

            // Delete Old
            if($user->profile_image){
                $img = '/uploads/user/' . $user->profile_image;

                if(Storage::disk(env('FILE_DISK'))->exists($img)){
                    Storage::disk(env('FILE_DISK'))->delete($img);
                }
            }
            $p_img = $photo;
        }
        $data =$request->only(['last_name','member_type_id','amount']);

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
                $destination = '/uploads/user/doc';
                $file->storeAs(
                    $destination,
                    $photo,
                    env('FILE_DISK')
                );
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
                $info +=[
                    $fl=>'/uploads/user/doc/'.$fileName
                ];
            }
        }

        $data +=[
            'profile_image'=>$p_img,
            'status'=>'approved',
            'info'=>json_encode($info),
        ];
        if ($request->input('amount') && $request->amount !=null && $request->amount >0){
            $data +=[
                'payment_status'=>'unpaid',
            ];
            $user->update($data);
            return redirect()->route('member.payment');
        }
        $data +=[
            'payment_status'=>'free',
        ];
        $user->update($data);
        return redirect()->route('memberDashboard')->with('success-alert2', 'Form submitted successfully.');
    }

    public function memberDashboard(){
        $user =auth()->user();
        if(auth()->user()->status == 'before_submit'){
            return redirect()->route('user.form')->with('error-alert2', 'Please add your information.');
        }else if($user->payment_status == 'unpaid' && $user->amount != null && $user->amount > 0){
            return redirect()->route('member.payment')->with('error-alert2', 'Please complete your payment.');
        }
        $donation = Donation::where(['user_id'=>auth()->user()->id,'payment_status'=>'succeeded']);
        $contribution_amount = $donation->sum('amount');
        $contribution_total = $donation->count();
        $total_event_join = EventJoin::where(['user_id'=>auth()->id()])->count();
        return view('front.member.member_dashboard',compact('contribution_amount','contribution_total','total_event_join'));
    }
    public function memberProfile(){
        $user=auth()->user();
        return view('front.member.member_profile',compact('user'));
    }
    public function memberContribution(){
        $donations = Donation::where(['user_id'=>auth()->user()->id])->get();
        return view('front.member.member_contribution',compact('donations'));
    }
    public function memberEventJoin(){
        $event_joins = EventJoin::where(['user_id'=>auth()->id()])->get();
        return view('front.member.member_event_join',compact('event_joins'));
    }

    public function memberUpdate(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email'=>'required|email|unique:users,email,'.auth()->id(),
            'profile_image'=>'mimes:jpg,png,jpeg,gif',
        ]);

        $user =auth()->user();
        $data =$request->only(['first_name','last_name','email']);
        $member_type=MemberType::find($user->member_type_id);
        if (isset($member_type->id)){
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
                'amount'=>$info_before['amount'],
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
                    $file->move($destination, $fileName);
                    $info +=[
                        $fl=>'/uploads/user/doc/'.$fileName
                    ];
                }else{
                    $info +=[
                        $fl=>$info_before[$fl]
                    ];
                }
            }

            $data +=[
                'info'=>json_encode($info),
            ];
        }

        $img_p =$user->profile_image;
        if($request->file('profile_image')){
            $image = $request->file('profile_image');
            $filename    = time() . '.' . $image->getClientOriginalExtension();

            // Resize Image 150*150
            $image_resize = Image::make($image->getRealPath());
            $image_resize->fit(150, 150);
            $image_resize->encode($image->getClientOriginalExtension());
            Storage::disk(env('FILE_DISK'))->put('/uploads/user/' . $filename,(string)$image_resize);



            if($user->profile_image){
                $img = '/uploads/user/' . $user->profile_image;
                if(Storage::disk(env('FILE_DISK'))->exists($img)){
                    Storage::disk(env('FILE_DISK'))->delete($img);
                }

            }
            $img_p = $filename;
        }
        $data +=[
            'profile_image'=>$img_p,
        ];

        try {
            $user->update($data);
            return redirect()->back()->with('success-alert', 'Profile updated successfully.');
        }catch (\Exception $e){
            return redirect()->back()->with('error-alert', 'Profile updated fail.');
        }

    }
    public function updatePassword(Request $request) {
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

    public function memberPaymentPage()
    {
        //dd("working");
        $user=auth()->user();
        if($user->payment_status == 'paid'){
            return redirect()->route('memberDashboard')->with('error-alert2', 'Sorry! Your membership payment already paid.');
        }else if($user->payment_status == 'free'){
            return redirect()->route('memberDashboard')->with('error-alert2', 'Sorry! Your membership is free don\'t need to pay.');
        }
        return view('front.member.memberPayment',compact('user'));
    }
    public function memberPaymentStore(Request $request)
    {
        //dd($request->all());
        $user=auth()->user();
        if($user->payment_status == 'paid'){
            return redirect()->route('memberDashboard')->with('error-alert2', 'Sorry! Your membership payment already paid.');
        }else if($user->payment_status == 'free'){
            return redirect()->route('memberDashboard')->with('error-alert2', 'Sorry! Your membership is free don\'t need to pay.');
        }
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = Stripe\Charge::create ([
            "amount" => $user->amount * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Membership Payment"
        ]);
        if($stripe->status == 'succeeded'){
            $user->update(['payment_status'=>'paid']);
            return redirect()->route('memberDashboard')->with('success-alert2', 'Your payment successful.');
        }else{
            return redirect()->route('homepage')->with('error-alert2', 'Your payment fail try again.');
        }
    }
}
