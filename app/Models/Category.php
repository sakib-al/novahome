<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
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

    // Media
    public function Media(){
        return $this->belongsTo(Media::class);
    }

    public function getImgPathsAttribute(){
        if($this->Media){
            return $this->Media->paths;
        }else{
            return [
                'original' => Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
                'small' => Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
                'medium' => Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
                'large' => Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
            ];
        }
    }

    public function Categories(){
        return $this->hasMany(Category::class)->orderBy('position');
    }

    public function getRouteAttribute(){
        if($this->for == 'blog'){
            return route('blog.category', $this->id);
        }
        return route('category', $this->id);
    }

    public function Gallery(){
        return $this->belongsTo(Gallery::class)->where('status', 1);
    }

    public function GalleryImages(){
        $images = Gallery::join('gallery_items', 'galleries.id', 'gallery_items.gallery_id')
        ->where('galleries.category_id', $this->id)
        ->where('galleries.status', 1)
        ->orderBy('gallery_items.position')->take(8)->get();

        return $images;
    }
}
