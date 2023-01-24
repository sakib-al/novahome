<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteAnswer extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id', 'vote_id', 'vote_question_id', 'answer','ip','location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAnswerersArrAttribute(){
        return json_decode($this->answer, true);
    }

}
