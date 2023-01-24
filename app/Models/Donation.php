<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'fund_raiser_id', 'user_id','info', 'name', 'mobile_no', 'email', 'payment_type', 'f_payment', 't_duration', 'amount', 'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fundRaiser()
    {
        return $this->belongsTo(Fundraiser::class);
    }
}
