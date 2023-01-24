<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'role', 'status', 'amount', 'payment_status', 'first_name', 'last_name', 'nick_name', 'email', 'member_type_id',
        'info', 'mobile_number', 'dob', 'place_of_birth', 'facebook_link', 'father_name', 'marital_status', 'spouse_name',
        'spouse_dob', 'gender', 'blood_group', 'profile_image', 'mailing_address', 'mailing_city', 'mailing_district',
        'mailing_post_code', 'mailing_country', 'contact_no_res', 'permanent_address', 'permanent_city', 'permanent_district',
        'permanent_post_code', 'permanent_country', 'address', 'password', 'payment_method', 'payment_trx_number', 'update_note',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => 'int',
        'member_type_id' => 'int',
    ];

    // Active
    public function scopeActive($q, $order = 'id', $type = null, $take = null){
        $q->where('status', 1);
        if($type){
            $q->where('type', $type);
        }
        $q->latest($order);
        if($take){
            $q->take($take);
        }
    }

    public function getStatusStringAttribute(){
        if($this->status == 0){
            return 'Suspended';
        }elseif($this->status == 2){
            return 'Pending';
        }
        return 'Active';
    }

    // Profile paths
    public function getProfilePathAttribute(){
        if($this->profile_image && Storage::disk(env('FILE_DISK'))->exists('uploads/user/' . $this->profile_image)){
            return Storage::disk(env('FILE_DISK'))->url('uploads/user/' . $this->profile_image);
        }

        return Storage::disk(env('FILE_DISK'))->url('img/user-img.jpg');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFullAddressAttribute()
    {
        return $this->street . ', ' . $this->city . ', ' . $this->state . ', ' . $this->zip . ', ' . $this->country;
    }

    public function memberType()
    {
        return $this->belongsTo(MemberType::class);
    }

}
