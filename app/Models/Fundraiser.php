<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Fundraiser extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='fund_raisers';
    protected $fillable=[
        'status', 'title', 'targeted_fund', 'collected_fund', 'people_donated', 'short_description',
        'description', 'f_of_payments', 'default_amounts',
        'fields', 'position', 'featured', 'meta_title', 'meta_description', 'meta_tags', 'image', 'media_id',
    ];
    // Active
    public function scopeActive($q, $take = null){
        $q->where('status', 2);
        $q->latest('id');
        if($take){
            $q->take($take);
        }
    }

    // Media
    public function Media(){
        return $this->belongsTo(Media::class);
    }
    public function getImgPathsAttribute(){
        if($this->Media){
            return $this->Media->paths;
        }else{
            return [
                'original' => Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
                'small' => Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
                'medium' => Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
                'large' =>Storage::disk(env('FILE_DISK'))->url('img/no-image.png'),
            ];
        }
    }

    public function getPercentAttribute()
    {
        $remaining = $this->targeted_fund - $this->collected_fund;

        $save_in_one = $remaining / $this->targeted_fund;
        $percent_amount = 100 - (int) ($save_in_one * 100);

        return $percent_amount;
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'fund_raiser_id');
    }

}
