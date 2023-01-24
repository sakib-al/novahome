<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionDesignType extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','is_active'
    ];
}
