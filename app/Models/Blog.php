<?php

namespace App\Models;

use App\Models\Product\Category;
use App\Repositories\MediaRepo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Active
    public function scopeActive($q, $take = null){
        $q->where('status', 1);
        $q->latest('id');
        if($take){
            $q->take($take);
        }
    }

    // Image Paths
    public function getImgPathsAttribute(){
        return MediaRepo::sizes($this->image_path, $this->image);
    }

    public function getRouteAttribute(){
        return route('news.single', $this->id);
    }

    // Category
    public function Categories(){
        return $this->belongsToMany(Category::class, 'blog_categories');
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function getCustomShortDescriptionAttribute(){
        return Str::words(strip_tags($this->description), 15,'....');
    }

    public function getVideoPathAttribute(){
        if($this->video){

            return Storage::disk(env('FILE_DISK'))->url('uploads/blog/video/' . $this->video);
        }
        return '';
    }
}
