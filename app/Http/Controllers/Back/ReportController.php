<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationForm;
use App\Models\Fundraiser;
use App\Models\MemberType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function memberReports(Request $request){


        $users = User::where(['type'=>'member'])->get();
        $member_types=MemberType::all();

        if($request->input('status')){

            $users=$users->where('status',$request->status);
        }

        if($request->input('member_type_id')){
            $users=$users->where('member_type_id',$request->member_type_id);
        }
        if($request->input('from_date')){
            $users=$users->where('created_at','>=',Carbon::parse($request->from_date));
        }

        if($request->input('to_date')){
            $users=$users->where('created_at','<=',Carbon::parse($request->to_date));
        }

        return view('back.reports.memberReport', compact('users','member_types'));
    }

    public function donations(Request $request){
        //dd($request->all());
        $donations = Donation::where(['payment_status'=>'succeeded'])->get();

        if($request->input('fund_raiser_id')){
            $donations = $donations->where('fund_raiser_id',$request->fund_raiser_id);
        }
        if($request->input('payment_type')){
            $donations = $donations->where('payment_type',$request->payment_type);
        }
        if($request->input('f_of_payment')){
            $donations = $donations->where('f_payment',$request->f_of_payment);
        }
        if($request->input('from_date')){
            $donations=$donations->where('created_at','>=',Carbon::parse($request->from_date));
        }

        if($request->input('to_date')){
            $donations=$donations->where('created_at','<=',Carbon::parse($request->to_date));
        }

        $member_types=MemberType::all();
        $f_of_payments = [];
        $ff= DonationForm::first();
        if(isset($ff->id)) $f_of_payments=json_decode($ff->f_of_payment);
        $contributions = Fundraiser::all();
        return view('back.reports.donationReport', compact('donations','member_types','f_of_payments','contributions'));
    }
}
