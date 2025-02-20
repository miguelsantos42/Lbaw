<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Added to define Eloquent relationships.
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'blocked'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the cards for a user.
     */

     public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'usersid');
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
    
    //-- Follow Tags
    public function followedTags()
    {
        return $this->belongsToMany(Tag::class, 'followedtags', 'usersid', 'tagid');
    }

    public function followsT(Tag $tag)
    {
        return $this->followedTags()->where('tagid', $tag->id)->exists();
    }
    
    //-- Follow Questions
    public function followedQuestions()
    {
        return $this->belongsToMany(Question::class, 'followedquestions', 'usersid', 'questionid');
    }

    public function followsQ(Question $question)
    {
        return $this->followedQuestions()->where('questionid', $question->id)->exists();
    }

}
