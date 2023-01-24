<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Reunion extends Model
{
    use HasFactory, SoftDeletes;

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
                'medium' =>Storage::disk(env('FILE_DISK'))->url('/img/no-image.png.png'),
                'large' =>Storage::disk(env('FILE_DISK'))->url('/img/no-image.png.png'),
            ];
        }
    }

    public function ReunionInputs(){
        return $this->hasMany(ReunionInput::class);
    }
}
