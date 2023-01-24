<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\MediaRepo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('category_id', null)->where('for', 'product')->latest('id')->get();

        return view('back.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('category_id', null)->where('for', 'product')->latest('id')->get();
        return view('back.category.create', compact('categories'));
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
            'title' => 'required|max:255'
        ];

        if($request->file('image')){
            $v_data['image'] = 'mimes:jpg,png,jpeg,gif';
        }

        $request->validate($v_data);

        $category = new Category;
        $category->title = $request->title;
        if($request->category_id){
            $category->category_id = $request->category_id;
        }
        if($request->for){
            $category->for = $request->for;
        }
        $category->description = $request->description;
        $category->short_description = $request->short_description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_tags = $request->meta_tags;
        $category->background_color = $request->background_color;

        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $category->image = $uploaded_file['full_file_name'];
            $category->media_id = $uploaded_file['media_id'];
        }

        $category->save();

        return redirect()->back()->with('success-alert', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('back.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('back.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        $category->title = $request->title;
        $category->short_description = $request->short_description;
        $category->description = $request->description;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_tags = $request->meta_tags;
        $category->background_color = $request->background_color;
        if($request->feature_position)
            $category->feature_position = $request->feature_position;

        if($request->file('image')){
            $uploaded_file = MediaRepo::upload($request->file('image'));
            $category->image = $uploaded_file['full_file_name'];
            $category->media_id = $uploaded_file['media_id'];
        }

        $category->save();

        return redirect()->back()->with('success-alert', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('back.blogs.categories')->with('success-alert', 'Category deleted successfully.');
    }

    public function delete(Category $category){
        $category->delete();

        return redirect()->route('back.categories.index')->with('success-alert', 'Category deleted successfully.');
    }

    public function getSubOptions(Request $request){
        $categories = Category::where('for', 'product')->where('category_id', $request->category_id)->active()->get();

        $output = '<option value="">Select category</option>';
        foreach($categories as $category){
            $output .= "<option value='$category->id'>$category->title</option>";
        }

        return $output;
    }

    public function updateAjax(Request $request){
        $category = Category::find($request->id);
        $category->title = $request->title;
        $category->save();

        return 'true';
    }

    public function removeImage(Category $category){
        $category->image = null;
        $category->media_id = null;
        $category->save();

        return redirect()->back()->with('success-alert', 'Category images deleted successfully.');
    }
}
