<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPostOfTheUser extends Model
{
    //
    protected $table = 'blog_post_of_the_user';

    public function blog()
    {
        return $this->belongsTo('App\BlogPost','blog_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
