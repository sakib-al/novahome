<?php

namespace App\Models;

use App\Repositories\MediaRepo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeSection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'section_name', 'background_color', 'col', 'row', 'section_name_is_show', 'title', 'sub_title',
        'section_design_type_id', 'position', 'text_align', 'is_image_inner_border', 'image', 'image_path', 'media_id',
        'short_description', 'description', 'button_name', 'button_url', 'raised_amount', 'raised_percentage','parallax_option', 'status', 'created_by', 'updated_by',
    ];
    protected $hidden=['deleted_at','created_at','updated_at'];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function sectionName()
    {
        return $this->belongsTo(SectionName::class);
    }
    // Image Paths
    public function getImgPathsAttribute(){
        return MediaRepo::sizes($this->image_path, $this->image);
    }
}
