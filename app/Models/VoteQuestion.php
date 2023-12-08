<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteQuestion extends Model
{
    protected $table = 'voteQuestions';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'updown',
        'usersid',
        'questionid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usersid');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'questionid');
    }
}
