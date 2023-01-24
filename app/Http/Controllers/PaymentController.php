<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Traits\EmailSentTraits;
use Illuminate\Http\Request;
use Stripe;
class PaymentController extends Controller
{
    use EmailSentTraits;
    /*
     * method for donation page show
     * */
    public function donation(Request $request)
    {

        $request->validate([
            'fund_raiser_id'=>'not_in:0|exists:fund_raisers,id',
            'payment_type'=>'required|numeric',
            'f_payment'=>'max:191',
            'amount'=>'required|numeric|not_in:0',
            'email'=>'email|max:191',
        ]);
        $data=$request->only(['fund_raiser_id','payment_type','f_payment','amount','email']);
        $data +=[
            'payment_status'=>'pending',
            'info'=>json_encode($request->except(['_token','_method','fund_raiser_id','payment_type','f_payment','amount']))
        ];
        if(auth()->check()){
            $data +=[
                'user_id'=>auth()->id(),
            ];
        }
        //dd($request->all());
        try {
            $donation =Donation::create($data);
            return view('front.paymentStripe',compact('donation'));
        }catch (\Exception $e){
            return redirect()->back()->with('error-alert2', 'Invalid request try again.');
        }

    }
    /*
     * method for strip payment
     * */
    public function payment(Request $request)
    {
        $donation = Donation::findOrFail($request->donation_id);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = Stripe\Charge::create ([
            "amount" => $donation->amount,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Donate Payment"
        ]);
        if($stripe->status == 'succeeded'){
            $donation->update(['payment_status'=>'succeeded']);
            if ($donation->fund_raiser_id){
                $this->contributionEmailNotification($donation->amount,$donation->email);
            }else{
                $this->donationEmailNotification($donation->amount,$donation->email);
            }

            return redirect()->route('homepage')->with('success-alert2', 'Your payment successful.');
        }else{
            $donation->update(['payment_status'=>'fail']);
            return redirect()->route('homepage')->with('error-alert2', 'Your payment fail try again.');
        }
    }
}
