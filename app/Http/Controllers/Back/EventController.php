<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventJoin;
use App\Models\JoinType;
use App\Repositories\MediaRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::latest('id')->get();

        return view('back.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.events.create');
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
        $v_data = [
            'title' => 'required|max:255',
            'date' => 'required',
            'short_description' => 'required|max:500',
            'description' => 'required'
        ];

        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }
        $request->validate($v_data);
        $data = $request->only(['title','description']);
        $data +=[
            'date'=>Carbon::parse($request->date),
        ];
        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $data +=[
                'image'=>$uploaded_file['full_file_name'],
                'media_id'=>$uploaded_file['media_id'],
            ];
        }
        $event = Event::create($data);
        $j_type=[];
        foreach ($request->join_type as $key=>$type){
            $attributes=[];
            foreach ($request->label[$key] as $key2=>$lb){
                $attributes []=[
                    'label'=>$lb,
                    'input_name'=>$request->input_name[$key][$key2],
                    'input_type'=>$request->type[$key][$key2],
                    'is_required'=>$request->is_required[$key][$key2],
                    'options'=>isset($request->value[$key][$key2])?$request->value[$key][$key2]:[],
                ];
            }
            $j_type[]=[
                'name'=>$type,
                'event_id'=>$event->id,
                'position'=>$request->position[$key],
                'is_free'=>$request->payment_option[$key],
                'amount'=>$request->payment_option[$key]==0?$request->amount[$key]:null,
                'is_limit'=>$request->join_limit[$key],
                'limit'=>$request->join_limit[$key]==1?$request->limit[$key]:null,
                'attributes'=>json_encode($attributes),
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        }
        JoinType::insert($j_type);
        //dd($j_type);
        return redirect()->back()->with('success-alert', 'Event created successfully.');
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
    public function edit(Event $event)
    {
        $event = $event->with(['joinType'])->where(['id'=>$event->id])->first();
        /*$event_joins = $event->joinType;
        dd($event_joins);*/
        return view('back.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $v_data = [
            'title' => 'required|max:255',
            'date' => 'required',
            'short_description' => 'required|max:500',
            'description' => 'required'
        ];

        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }
        $request->validate($v_data);
        $data = $request->only(['title','description', 'short_description']);
        $data +=[
            'date'=>Carbon::parse($request->date),
        ];
        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $data +=[
                'image'=>$uploaded_file['full_file_name'],
                'media_id'=>$uploaded_file['media_id'],
            ];
        }
        $event->update($data);

        $j_type=[];
        foreach ((array)$request->join_type as $key=>$type){
            $attributes=[];
            foreach ($request->label[$key] as $key2=>$lb){
                $attributes []=[
                    'label'=>$lb,
                    'input_name'=>$request->input_name[$key][$key2],
                    'input_type'=>$request->type[$key][$key2],
                    'is_required'=>$request->is_required[$key][$key2],
                    'options'=>isset($request->value[$key][$key2])?$request->value[$key][$key2]:[],
                ];
            }
            $j_type[]=[
                'name'=>$type,
                'event_id'=>$event->id,
                'position'=>$request->position[$key],
                'is_free'=>$request->payment_option[$key],
                'amount'=>$request->payment_option[$key] == 0?$request->amount[$key]:null,
                'is_limit'=>$request->join_limit[$key],
                'limit'=>$request->join_limit[$key]==1?$request->limit[$key]:null,
                'attributes'=>json_encode($attributes),
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        }

        try {
            $event->joinType()->delete();
        }catch (\Exception $e){
            //
        }
        $event->joinType()->insert($j_type);
        return redirect()->back()->with('success-alert', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('back.events.index')->with('success-alert', 'Event deleted successfully.');
    }

    public function removeImage(Event $event){
        $event->image = null;
        $event->media_id = null;
        $event->save();

        return redirect()->back()->with('success-alert', 'Event images deleted successfully.');
    }

    public function eventResponse(Event $event)
    {
        return view('back.events.show',compact('event'));
    }

    public function eventMemberStatusChange(EventJoin $eventJoin)
    {
        if($eventJoin->status==1){
            $eventJoin->update(['status'=>0]);
        }else{
            $eventJoin->update(['status'=>1]);
        }
        return response()->json(['status'=>'success','message'=>"Successfully changed"]);
    }
}
