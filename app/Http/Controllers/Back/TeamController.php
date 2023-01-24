<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use App\Models\User;
use App\Repositories\MediaRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = OurTeam::all();

        return view('back.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|max:191',
            'designation' => 'required|max:191',
            'member_type' => 'required|numeric',
            'image' => 'image|mimes:jpg,png,jpeg',
        ]);
        $data = $request->except('image');
        // Insert Profile Image
        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $data += [
                'image'=> $uploaded_file['file_name'],
                'image_path'=> $uploaded_file['file_path'],
                'media_id'=> $uploaded_file['media_id'],
            ];
        }
        $data +=[
            'created_by'=>auth()->id(),
        ];
        try {
            OurTeam::create($data);
            return redirect()->back()->with('success-alert', 'Member created successfully.');
        }catch (\Exception $e){
            return redirect()->back()->with('error-alert', 'Member can\'t created successfully.');
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $our_team = OurTeam::findOrFail($id);

        return view('back.teams.edit', compact('our_team'));
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
        $ourTeam =OurTeam::findOrFail($id);
        $request->validate([
            'name' => 'required|max:191',
            'designation' => 'required|max:191',
            'member_type' => 'required|numeric',
            'image' => 'image|mimes:jpg,png,jpeg',
        ]);
        $data = $request->except('image');
        // Insert Profile Image
        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $data += [
                'image'=> $uploaded_file['file_name'],
                'image_path'=> $uploaded_file['file_path'],
                'media_id'=> $uploaded_file['media_id'],
            ];
        }
        $data +=[
            'updated_by'=>auth()->id(),
        ];
        try {
            $ourTeam->update($data);
            return redirect()->back()->with('success-alert', 'Member updated successfully.');
        }catch (\Exception $e){
            return redirect()->back()->with('error-alert', 'Member can\'t updated successfully.');
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
        $team = OurTeam::findOrFail($id);
        $team->delete();

        return redirect()->route('back.teams.index')->with('success-alert', 'Member deleted successfully.');
    }

}
