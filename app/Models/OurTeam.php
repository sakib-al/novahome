<?php

namespace App\Models;

use App\Repositories\MediaRepo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OurTeam extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['name','image','image_path','media_id', 'designation', 'member_type', 'description', 'position', 'is_active', 'created_by', 'updated_by',];
    protected $hidden=['created_by', 'updated_by','created_at','updated_at','deleted_at'];
    // Image Paths
    public function getImgPathsAttribute(){
        return MediaRepo::sizes($this->image_path, $this->image);
    }
}
