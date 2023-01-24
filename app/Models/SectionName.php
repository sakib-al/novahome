<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionName extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'title', 'title_align', 'position', 'section_design_type_id', 'background_color', 'col', 'row', 'title_is_show', 'created_by', 'updated_by',
    ];

    public function sectionDesignType()
    {
        return $this->belongsTo(SectionDesignType::class);
    }
}
