<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    public const LIKE_TYPE = 'like';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'post_comment_id', 'reaction_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /*
     * Relationships
     */

    public function user()
    {
        return $this->hasOne('App\Model\User', 'id', 'user_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Model\Post', 'post_id');
    }

    public function comment()
    {
        return $this->belongsTo('App\Model\PostComment', 'post_comment_id');
    }
}
