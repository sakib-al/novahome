<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class GalleryItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'gallery_id', 'image', 'position'
    ];
    public function getImgPathsAttribute(){
        $file_name = $this->image;
        $output = array();

        if(Storage::disk(env('FILE_DISK'))->exists("uploads/gallery/small/$file_name")){
            $output['small'] =Storage::disk(env('FILE_DISK'))->url("uploads/gallery/small/$file_name");
        }else{
            $output['small'] =$path = Storage::disk(env('FILE_DISK'))->url('/img/no-image.png');
        }

        if(file_exists(public_path("uploads/gallery/medium/$file_name"))){
            $output['medium'] = Storage::disk(env('FILE_DISK'))->url("uploads/gallery/medium/$file_name");
        }else{
            $output['medium'] = Storage::disk(env('FILE_DISK'))->url('/img/no-image.png');
        }
        if(file_exists(public_path("uploads/gallery/large/$file_name"))){
            $output['large'] = Storage::disk(env('FILE_DISK'))->url("uploads/gallery/large/$file_name");
        }else{
            $output['large'] = Storage::disk(env('FILE_DISK'))->url('/img/no-image.png');
        }
        if(file_exists(public_path("uploads/gallery/$file_name"))){
            $output['original'] = Storage::disk(env('FILE_DISK'))->url("uploads/gallery/$file_name");
        }else{
            $output['original'] =Storage::disk(env('FILE_DISK'))->url('/img/no-image.png');
        }

        return $output;
    }
}
