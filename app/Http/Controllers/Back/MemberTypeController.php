<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\MemberType;
use App\Repositories\MediaRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberTypeController extends Controller
{
    public function index()
    {
        $member_types=MemberType::all();
        return view('back.members.memberType.index',compact('member_types'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $v_data = [
            'name' => 'required|max:255',
            'position' => 'required|numeric',
            'payment_option' => 'required|numeric',
            'join_limit' => 'required|numeric',
            'amount' => 'numeric',
            'limit' => 'numeric',
            'type' => 'required',
            'label' => 'required',
            'input_name' => 'required',
            'is_required' => 'required',
        ];
        $request->validate($v_data);

        $data = $request->only(['name','position','join_limit','amount','limit']);
        $data +=[
            'is_free'=>$request->payment_option !=1?1:0,
        ];
        $attributes=[];
        foreach ($request->label as $key2=>$lb){
            $attributes []=[
                'label'=>$lb,
                'input_name'=>$request->input_name[$key2],
                'input_type'=>$request->type[$key2],
                'is_required'=>$request->is_required[$key2],
                'options'=>isset($request->value[$key2])?$request->value[$key2]:[],
            ];
        }
        $data +=[
            'attributes'=>json_encode($attributes),
        ];
        MemberType::create($data);
        return redirect()->back()->with('success-alert', 'Created successfully.');
    }

    public function create()
    {
        return view('back.members.memberType.create');
    }

    public function edit(MemberType $memberType)
    {
        return view('back.members.memberType.edit',compact('memberType'));
    }
    public function update(Request $request, MemberType $memberType)
    {
        $v_data = [
            'name' => 'required|max:255',
            'position' => 'required|numeric',
            'payment_option' => 'required|numeric',
            'join_limit' => 'required|numeric',
            'amount' => 'numeric',
            'limit' => 'numeric',
            'type' => 'required',
            'label' => 'required',
            'input_name' => 'required',
            'is_required' => 'required',
        ];
        $request->validate($v_data);
        $data = $request->only(['name','position','join_limit','limit']);

        $data +=[
            'is_free'=>$request->payment_option !=1?1:0,
            'amount'=>$request->payment_option ==2?0:$request->amount,
        ];

        $attributes=[];
        foreach ($request->label as $key2=>$lb){
            $attributes []=[
                'label'=>$lb,
                'input_name'=>$request->input_name[$key2],
                'input_type'=>$request->type[$key2],
                'is_required'=>$request->is_required[$key2],
                'options'=>isset($request->value[$key2])?$request->value[$key2]:[],
            ];
        }
        $data +=[
            'attributes'=>json_encode($attributes),
        ];
        $memberType->update($data);
        return redirect()->back()->with('success-alert', 'Created successfully.');
    }

    public function destroy(MemberType $memberType)
    {
        $memberType->delete();
        return redirect()->route('back.member.type.index');
    }

}
