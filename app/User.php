<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const user = 1;
    const admin = 2;
    const super_admin = 3;

    const linkedin_login = 1;

    const status_inactive = 0;
    const status_active = 1;

    const not_mentorat = 0;
    const mentorat = 1;
    const in_standby_mentorat = 2;

    public function chooseColor()
    {
        return $this->belongsTo('App\CategoryOfTheUser','id','user_id');
    }
    public function GetGraduationYear()
    {
        return $this->belongsTo('App\GraduationYear','graduation_year_id');
    }

    public function chooseSchool()
    {
        return $this->HasMany('App\SchoolOfTheUser','user_id');
    }

    public function chooseDegree()
    {
        return $this->HasMany('App\DegreeOfTheUser','user_id');
    }

    public function chooseJob()
    {
        return $this->HasMany('App\JobOfTheUser','user_id');
    }

    public function myJob()
    {
        return $this->HasMany('App\JobBoard','user_id');
    }

    public function myBlog()
    {
        return $this->HasMany('App\BlogPostOfTheUser','user_id');
    }

    public function GetToken()
    {
        return $this->belongsTo('App\Token','id','user_id');
    }

    public function GetAdminSchool()
    {
        return $this->belongsTo('App\AdminOfTheSchool','id','admin_id');
    }

}

