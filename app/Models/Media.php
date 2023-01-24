<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    // Paths
    public function getPathsAttribute(){
        $image_path = $this->year . '/' . $this->month;
        $file_name = $this->file_name;

        $output['original'] = env('AWS_URL')."/uploads/$image_path/$file_name";

        // dd(public_path("uploads/$image_path/small_$file_name"));
        if(Storage::disk(env('FILE_DISK'))->exists("/uploads/$image_path/small_$file_name")){
            $output['small'] = Storage::disk(env('FILE_DISK'))->url("/uploads/$image_path/small_$file_name");
            // asset("uploads/$image_path/small_$file_name");
        }else{
            $output['small'] =$path = Storage::disk(env('FILE_DISK'))->url('/img/no-image.png');
            // 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/'."/img/no-image.png.png";
            // asset('img/no-image.png.png');
        }
        if(Storage::disk(env('FILE_DISK'))->exists("/uploads/$image_path/medium_$file_name")){
            $output['medium'] =Storage::disk(env('FILE_DISK'))->url("/uploads/$image_path/medium_$file_name");
            // asset("uploads/$image_path/medium_$file_name");
        }else{
            $output['medium'] =Storage::disk(env('FILE_DISK'))->url('/img/no-image.png');
        }
        if(Storage::disk(env('FILE_DISK'))->exists("/uploads/$image_path/large_$file_name")){

            $output['large'] = Storage::disk(env('FILE_DISK'))->url("/uploads/$image_path/large_$file_name");
            //  env('AWS_URL')."/uploads/$image_path/large_$file_name";
            // asset("uploads/$image_path/large_$file_name");
        }else{
            $output['large'] = Storage::disk(env('FILE_DISK'))->url('/img/no-image.png');
        }

        return $output;

        // $output['original'] = asset("uploads/$year_month/$file_name");

        // if(file_exists(public_path("uploads/$year_month/small_$file_name"))){
        //     $output['small'] = Storage::disk(env('FILE_DISK'))->url("/uploads/$image_path/small_$file_name")  asset("uploads/$year_month/small_$file_name");
        // }else{
        //     $output['small'] = asset('img/no-image.png');
        // }
        // if(file_exists(public_path("uploads/$year_month/medium_$file_name"))){
        //     $output['medium'] = asset("uploads/$year_month/medium_$file_name");
        // }else{
        //     $output['medium'] = asset('img/no-image.png');
        // }
        // if(file_exists(public_path("uploads/$year_month/large_$file_name"))){
        //     $output['large'] = asset("uploads/$year_month/large_$file_name");
        // }else{
        //     $output['large'] = asset('img/no-image.png');
        // }

        // return $output;
    }
}
