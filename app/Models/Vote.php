<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
class Vote extends Model
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

    // Media
    public function Media(){
        return $this->belongsTo(Media::class);
    }

    public function getImgPathsAttribute(){
        if($this->Media){
            return $this->Media->paths;
        }else{
            return [
                'original' => Storage::disk(env('FILE_DISK'))->url('/img/no-image.png.png'),
                'small' => Storage::disk(env('FILE_DISK'))->url('/img/no-image.png.png'),
                'medium' => Storage::disk(env('FILE_DISK'))->url('/img/no-image.png.png'),
                'large' => Storage::disk(env('FILE_DISK'))->url('/img/no-image.png.png'),
            ];
        }
    }

    public function Questions(){
        return $this->hasMany(VoteQuestion::class);
    }

    public function voteAnswer()
    {
        return $this->hasMany(VoteAnswer::class);
    }
}
