<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoteQuestion extends Model
{
    use HasFactory, SoftDeletes;

    public function getOptionsArrAttribute(){
        if($this->options){
            return json_decode($this->options);
        }
        return [];
    }
}
