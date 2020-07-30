<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'author', 'title', 'excerpt', 'content', 'thumbnail', "status"
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
