<?php

namespace App\Http\Controllers;

use App\Models\EventJoin;
use App\Models\JoinType;
use App\Traits\EmailSentTraits;
use Illuminate\Http\Request;
use Stripe;

class EventJoinController extends Controller
{
    use EmailSentTraits;
    public function eventJoin(Request $request){
        $request->validate([
            'event_id'=>'required|not_in:0|exists:events,id',
            'join_type_id'=>'required|not_in:0|exists:join_types,id',
            //'name'=>'required|string|max:191',
            'email'=>'email',
            //'phone_number'=>'string',
        ]);
        // dd(env('ADMIN_NOTIFY_MAIL'));
        $data = $request->only(['event_id','join_type_id','name','email','phone_number','amount']);
        $data +=[
            'values'=>json_encode($request->except(['_token','event_id','join_type_id','amount'])),
            'payment_status'=>'pending',
        ];
        if (auth()->check()){
            $data +=[
                'user_id'=>auth()->id(),
            ];
        }
        $event_join = EventJoin::create($data);
        $join_type = JoinType::find($request->join_type_id);

        if ($join_type->is_free ==  0){
            return redirect()->route('event.payment.page',$event_join->id);
        }else{
            //email notification sent
            $this->eventJoinEmail($event_join->email);
            return redirect()->route('homepage')->with('success-alert2', 'Join successfully.');
        }
	}

    public function eventPaymentPage(EventJoin $eventJoin)
    {
        return view('front.event.eventPayment',compact('eventJoin'));
    }

    public function eventPayment(Request $request)
    {
        $donation = EventJoin::findOrFail($request->event_join_id);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = Stripe\Charge::create ([
            "amount" => $donation->amount * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Event Payment"
        ]);
        if($stripe->status == 'succeeded'){
            $donation->update(['payment_status'=>1]);
            //email notification sent
            $this->eventJoinEmail($donation->email);
            return redirect()->route('homepage')->with('success-alert2', 'Your payment successful.');
        }else{
            $donation->update(['payment_status'=>'fail']);
            return redirect()->route('homepage')->with('error-alert2', 'Your payment fail try again.');
        }
    }
}
