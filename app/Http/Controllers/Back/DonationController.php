<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationForm;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::where(['fund_raiser_id'=>null,'payment_status'=>'succeeded'])->orderBy('id','asc')->get();
        $donation_form=DonationForm::first();

        return view('back.donation.index', compact('donations','donation_form'));
    }

    public function donationForm()
    {
        $donation_form = DonationForm::first();
        if (isset($donation_form->id))
            return view('back.donation.donationForm',compact('donation_form'));
        else return view('back.donation.donationForm');
    }

    public function donationStoreUpdate(Request $request)
    {
        $request->validate([
            'f_of_payments'=>'required',
            'default_amounts'=>'required',
            'type'=>'required',
            'label'=>'required',
            'input_name'=>'required',
            'is_required'=>'required',
        ]);
        $attributes=[];
        foreach ($request->label as $key=>$lb){
            $attributes []=[
                'label'=>$lb,
                'input_name'=>$request->input_name[$key],
                'input_type'=>$request->type[$key],
                'is_required'=>$request->is_required[$key],
                'options'=>isset($request->value[$key])?$request->value[$key]:[],
            ];
        }
        $data =[
            'f_of_payment'=>json_encode($request->f_of_payments),
            'default_amounts'=>json_encode($request->default_amounts),
            'fields'=>json_encode($attributes),
        ];
        $donation_form = DonationForm::first();
        if (isset($donation_form->id)){
            $donation_form->update($data);
        }else{
            DonationForm::create($data);
        }
        return redirect()->back()->with('success-alert2', 'Update successfully.');
    }
}
