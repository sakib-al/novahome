<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Reunion;
use App\Models\ReunionInput;
use App\Repositories\MediaRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reunions = Reunion::latest('id')->get();

        return view('back.reunions.index', compact('reunions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.reunions.create');
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
            'date' => 'required',
            'description' => 'required'
        ];

        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }

        $request->validate($v_data);

        $fundRaiser = new Reunion;
        $fundRaiser->title = $request->title;
        $fundRaiser->date = Carbon::parse($request->date);
        $fundRaiser->description = $request->description;

        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $fundRaiser->image = $uploaded_file['full_file_name'];
            $fundRaiser->media_id = $uploaded_file['media_id'];
        }

        $fundRaiser->save();

        return redirect()->back()->with('success-alert', 'Reunion created successfully.');
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
    public function edit(Reunion $reunion)
    {
        return view('back.reunions.edit', compact('reunion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reunion $reunion)
    {
        $v_data = [
            'title' => 'required|max:255',
            'date' => 'required',
            'description' => 'required'
        ];
        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }
        $request->validate($v_data);

        $reunion->title = $request->title;
        $reunion->date = Carbon::parse($request->date);
        $reunion->description = $request->description;

        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $reunion->image = $uploaded_file['full_file_name'];
            $reunion->media_id = $uploaded_file['media_id'];
        }

        $reunion->save();

        return redirect()->back()->with('success-alert', 'Reunion updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reunion $reunion)
    {
        $reunion->delete();

        return redirect()->route('back.reunions.index')->with('success-alert', 'Reunion deleted successfully.');
    }

    public function removeImage(Reunion $reunion){
        $reunion->image = null;
        $reunion->media_id = null;
        $reunion->save();

        return redirect()->back()->with('success-alert', 'Reunion images deleted successfully.');
    }

    public function inputCreate(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'type' => 'required',
        ]);

        $input = new ReunionInput;
        $input->reunion_id = $id;
        $input->name = $request->name;
        $input->type = $request->type;

        if($request->type == 'Option' || $request->type == 'Radio'){
            $input->options = json_encode((array)$request->option);
        }
        $input->save();

        return redirect()->back()->with('success-alert', 'Input created successfully.');
    }

    public function inputDelete($id){
        $input = ReunionInput::findOrFail($id);

        $input->delete();

        return redirect()->back()->with('success-alert', 'Input deleted successfully.');
    }

    public function inputEdit(Request $request){
        $input = ReunionInput::find($request->id);

        if($input){
            return view('back.reunions.inputEdit', compact('input'));
        }
        return '';
    }
    public function inputUpdate(Request $request){
        $request->validate([
            'input_id' => 'required',
            'name' => 'required|max:255',
            'type' => 'required',
        ]);

        $input = ReunionInput::findOrFail($request->input_id);
        $input->name = $request->name;
        $input->type = $request->type;

        if($request->type == 'Option' || $request->type == 'Radio'){
            $input->options = json_encode((array)$request->option);
        }else{
            $input->options = '';
        }
        $input->save();

        return redirect()->back()->with('success-alert', 'Input created successfully.');
    }
}
