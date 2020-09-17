<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    const Student = 1;
    const Alumni = 2;
    const Teacher = 3;
    const School_admin = 4;

}
