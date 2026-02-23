<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Likes extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'post_id'
    ];

    // A Like belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A Like belongs to a Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
