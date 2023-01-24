<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Models\VoteQuestion;
use App\Repositories\MediaRepo;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votes = Vote::latest('id')->get();

        return view('back.votes.index', compact('votes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.votes.create');
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
            'title' => 'required|max:255',
        ]);

        $vote = new Vote;
        $vote->title = $request->title;
        $vote->short_description = $request->short_description;
        $vote->description = $request->description;
        $vote->meta_title = $request->meta_title;
        $vote->meta_description = $request->meta_description;
        $vote->meta_tags = $request->meta_tags;

        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $vote->image = $uploaded_file['full_file_name'];
            $vote->media_id = $uploaded_file['media_id'];
        }

        $vote->save();

        return redirect()->back()->with('success-alert', 'Vote created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        $questions = $vote->Questions;
        if(count($questions)){
            return view('back.votes.showSurvey', compact('vote', 'questions'));
        }

        $ans=$vote->voteAnswer;
        $yes= $ans->where('answer','Yes')->count();
        $no= $ans->where('answer','No')->count();
        $no_comments= $ans->where('answer','No Comments')->count();

        return view('back.votes.show', compact('vote','yes','no','no_comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        return view('back.votes.edit', compact('vote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $vote->title = $request->title;
        $vote->short_description = $request->short_description;
        $vote->description = $request->description;
        $vote->meta_title = $request->meta_title;
        $vote->meta_description = $request->meta_description;
        $vote->meta_tags = $request->meta_tags;

        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $vote->image = $uploaded_file['full_file_name'];
            $vote->media_id = $uploaded_file['media_id'];
        }

        $vote->save();

        return redirect()->back()->with('success-alert', 'Vote updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        $vote->delete();

        return redirect()->route('back.votes.index')->with('success-alert', 'Vote deleted successfully.');
    }

    public function removeImage(Vote $vote){
        $vote->image = null;
        $vote->media_id = null;
        $vote->save();

        return redirect()->back()->with('success-alert', 'Vote images deleted successfully.');
    }

    public function questionCreate(Request $request){
        $request->validate([
            'type' => 'required',
            'question' => 'required|max:255',
        ]);

        $question = new VoteQuestion;
        $question->vote_id = $request->vote;
        $question->type = $request->type;
        $question->question = $request->question;

        if($request->type == 'Option'){
            $options = (array)$request->option_value;
            if(!count($options)){
                return redirect()->back()->with('error', 'Please add some options!');
            }

            $question->options = json_encode($options);
        }

        $question->save();

        return redirect()->back()->with('success-alert', 'Question created successfully.');
    }

    public function questionDelete($id){
        $question = VoteQuestion::findOrFail($id);
        $question->delete();

        return redirect()->back()->with('success-alert', 'Question deleted successfully.');
    }

    public function questionEditAjax(Request $request){
        $question = VoteQuestion::find($request->id);
        if($question){
            return view('back.votes.questionEditAjax', compact('question'));
        }

        return '';
    }

    public function questionUpdate(Request $request){
        $request->validate([
            'question_id' => 'required',
            'type' => 'required',
            'question' => 'required|max:255'
        ]);

        $question = VoteQuestion::findOrFail($request->question_id);
        $question->type = $request->type;
        $question->question = $request->question;

        if($request->type == 'Option'){
            $options = (array)$request->option_value;
            if(!count($options)){
                return redirect()->back()->with('error', 'Please add some options!');
            }

            $question->options = json_encode($options);
        }else{
            $question->options = null;
        }

        $question->save();

        return redirect()->back()->with('success-alert', 'Question updated successfully.');
    }
}
