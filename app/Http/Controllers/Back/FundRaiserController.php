<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Fundraiser;
use App\Repositories\MediaRepo;
use Illuminate\Http\Request;

class FundRaiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fundRaisers = Fundraiser::latest('id')->get();

        return view('back.fund-raisers.index', compact('fundRaisers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.fund-raisers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v_data = [
            'title' => 'required|max:255',
            'targeted_fund' => 'required',
            'description' => 'required',
            'f_of_payments' => 'required',
            'default_amounts' => 'required',
            'type' => 'required',
            'label' => 'required',
            'input_name' => 'required',
            'is_required' => 'required',
        ];

        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }

        $request->validate($v_data);
        $data = $request->except(['f_of_payments','default_amounts','type','label','input_name','is_required']);
        $data +=[
            'f_of_payments'=>json_encode($request->f_of_payments),
            'default_amounts'=>json_encode($request->default_amounts),
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
            'fields'=>json_encode($attributes),
        ];
        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $data +=[
                'image'=>$uploaded_file['full_file_name'],
                'media_id'=>$uploaded_file['media_id'],
            ];
        }

        Fundraiser::create($data);

        return redirect()->back()->with('success-alert', 'Donation Program created successfully.');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fundRaiser = Fundraiser::findOrFail($id);
        return view('back.fund-raisers.edit', compact('fundRaiser'));
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
        $v_data = [
            'title' => 'required|max:255',
            'targeted_fund' => 'required',
            'description' => 'required',
            'f_of_payments' => 'required',
            'default_amounts' => 'required',
            'type' => 'required',
            'label' => 'required',
            'input_name' => 'required',
            'is_required' => 'required',
        ];
        $fundraiser=Fundraiser::findOrFail($id);
        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }

        $request->validate($v_data);
        $data = $request->except(['f_of_payments','default_amounts','type','label','input_name','is_required']);
        $data +=[
            'f_of_payments'=>json_encode($request->f_of_payments),
            'default_amounts'=>json_encode($request->default_amounts),
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
            'fields'=>json_encode($attributes),
        ];
        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $data +=[
                'image'=>$uploaded_file['full_file_name'],
                'media_id'=>$uploaded_file['media_id'],
            ];
        }

        $fundraiser->update($data);
        return redirect()->back()->with('success-alert', 'Donation Program updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fundRaiser = Fundraiser::findOrFail($id);
        $fundRaiser->delete();

        return redirect()->route('back.fund-raisers.index')->with('success-alert', 'Donation Program deleted successfully.');
    }

    public function removeImage(Fundraiser $fundRaiser){
        $fundRaiser->image = null;
        $fundRaiser->media_id = null;
        $fundRaiser->save();

        return redirect()->back()->with('success-alert', 'Donation Program images deleted successfully.');
    }

    /*
     * method for get domation list
     * */
    public function donationList(Fundraiser $fundraiser)
    {
        $donations =$fundraiser->donations()->where(['payment_status'=>'succeeded'])->get();
        return view('back.fund-raisers.show',compact('fundraiser','donations'));
    }
}
