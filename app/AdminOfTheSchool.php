<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminOfTheSchool extends Model
{
    //
    protected $table = 'admin_of_the_school';

    public function GetAdminInfo()
    {
        return $this->belongsTo('App\User','admin_id' , 'id');
    }
    public function GetSchoolInfo()
    {
        return $this->belongsTo('App\School','school_id' );
    }
    public function GetSchoolDegree()
    {
        return $this->HasMany('App\DegreeOfTheSchool','school_id' , 'school_id');
    }
}
