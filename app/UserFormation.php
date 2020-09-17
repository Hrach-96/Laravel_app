<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFormation extends Model
{
    //
    protected $table = 'user_formation';
    public function GetGraduationYear()
    {
        return $this->belongsTo('App\GraduationYear','graduation_year_id');
    }
    public function GetFacilityName()
    {
        return $this->belongsTo('App\SchoolsOfRegsiterSurvey','facility_id');
    }

}
