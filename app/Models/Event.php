<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;
    protected $fillable=[
        'status', 'title', 'date', 'short_description', 'description', 'meta_title',
        'meta_description', 'meta_tags', 'image', 'media_id',
    ];
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
                'original' =>Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
                'small' => Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
                'medium' => Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
                'large' => Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
            ];
        }
    }

    public function getRouteAttribute(){
        return route('event', $this->id);
    }

    public function joinType()
    {
        return $this->hasMany(JoinType::class);
    }
    public function eventJoin()
    {
        return $this->hasMany(EventJoin::class);
    }
}
