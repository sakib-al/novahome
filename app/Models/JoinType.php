<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JoinType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'position', 'event_id', 'name', 'amount', 'is_free', 'attributes', 'is_limit', 'limit', 'status',
    ];

    protected $casts = [
        'id' => 'int',
        'event_id' => 'int',
        'is_free' => 'int',
        'is_limit' => 'int',
        'limit' => 'int',
        'status' => 'int',
    ];
}
