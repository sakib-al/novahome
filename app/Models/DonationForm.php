<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationForm extends Model
{
    use HasFactory;
    protected $fillable=[
        'status', 'title', 'description', 'image', 'f_of_payment', 'default_amounts', 'fields', 'meta_title', 'meta_description', 'meta_tags',
    ];
}
