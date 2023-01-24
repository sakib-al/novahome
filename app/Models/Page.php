<?php

namespace App\Models;

use App\Repositories\Generate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'slug'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'id']
            ]
        ];
    }

    // Active
    public function scopeActive($q, $take = null){
        $q->where('status', 1);
        $q->latest('id');
        if($take){
            $q->take($take);
        }
    }

    public function getRouteAttribute(){
        return route('common.page', $this->slug);
    }

    // Media
    public function Media(){
        return $this->belongsTo(Media::class);
    }

    public function getImgPathsAttribute(){
        //return MediaRepo::sizes($this->image_path, $this->image);
        if($this->Media){
            return $this->Media->paths;
        }else{
            return [
                'original' => Storage::disk(env('FILE_DISK'))->url('/img/no-image.png.png'),
                'small' => Storage::disk(env('FILE_DISK'))->url('/img/no-image.png.png'),
                'medium' =>Storage::disk(env('FILE_DISK'))->url('/img/no-image.png.png'),
                'large' => Storage::disk(env('FILE_DISK'))->url('/img/no-image.png.png'),
            ];
        }
    }
}
