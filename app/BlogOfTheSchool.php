<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogOfTheSchool extends Model
{
    //
    protected $table = 'blog_of_the_school';
    public function GetBlogInfo()
    {
        return $this->belongsTo('App\BlogPost','blog_id');
    }
}
