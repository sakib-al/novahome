<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use App\Models\SectionDesignType;
use App\Models\SectionName;
use App\Repositories\MediaRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Matrix\trace;

class HomeSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = HomeSection::orderBy('position','ASC')->get();
        $section_names=SectionName::all();
        $section_design_types=SectionDesignType::all();

        return view('back.frontend.section.index', compact('sliders','section_names','section_design_types'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_name'=>'required|string|max:191',
            'background_color'=>'',
            'section_name_is_show'=>'required',
            'title' => 'max:191',
            'image' => 'image|mimes:jpg,png,jpeg,gif'
        ]);
        $home_section=$request->except('image','position');
        if($request->input('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $home_section += [
                'image'=> $uploaded_file['file_name'],
                'image_path'=> $uploaded_file['file_path'],
                'media_id'=> $uploaded_file['media_id'],
                'created_by'=>auth()->id(),
            ];
        }
        $home_section += [
            'created_by'=>auth()->id(),
        ];

        try {
            HomeSection::create($home_section);
            return response()->json(['status'=>'success','message'=>'Successfully stored'],200);
        }catch (\Exception $e){
            return response()->json(['status'=>'success','message'=>'Cant\'t created.'],200);
        }
    }

    public function edit(HomeSection $homeSection)
    {
        $sliders = HomeSection::orderBy('position','ASC')->get();
        return view('back.frontend.section.edit', compact('homeSection','sliders'));
    }

    public function update(HomeSection $homeSection, Request $request)
    {
        $request->validate([
            'section_name'=>'required|string|max:191',
            'background_color'=>'',
            'section_name_is_show'=>'required',
            'title' => 'max:191',
            'image' => 'image|mimes:jpg,png,jpeg,gif'
        ]);
        $home_section=$request->except('image');
        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $home_section += [
                'image'=> $uploaded_file['file_name'],
                'image_path'=> $uploaded_file['file_path'],
                'media_id'=> $uploaded_file['media_id'],
            ];
        }
        $home_section += [
            'updated_by'=>auth()->id(),
        ];
        try {
            $homeSection->update($home_section);
            return response()->json(['status'=>'success','message'=>'Successfully updated.'],200);
        }catch (\Exception $e){
            return response()->json(['status'=>'error','message'=>'Cant updated.'],200);
        }
    }

    public function remove(HomeSection $homeSection)
    {
        $homeSection->delete();
        return redirect()->route('back.frontend.section')->with('success-alert', 'Successfully removed.');
    }

    public function positionUpdate(Request $request)
    {
        foreach ($request->ids as $i => $data) {
            $query = HomeSection::find($data);
            $query->update(['position'=>$i]);
        }
        return response()->json(['status'=>'success','message'=>"Successfully updated"],200);
    }

    public function sectionTypeStore(Request $request)
    {
        Validator::make($request->all(),[
            'title'=>'required|string|max:191',
            'section_design_type_id'=>'required|not_in:0',
        ])->validate();
        try {
            $ss = SectionName::create($request->all());
            if (isset($ss->id)) return response()->json(['status'=>'success','message'=>'Successfully sored'],200);
        }catch (\Exception $e){
            return response()->json(['status'=>'error','message'=>'Can\'t store information'],200);
        }
        return response()->json(['status'=>'error','message'=>'Invalid request'],404);

    }
}
