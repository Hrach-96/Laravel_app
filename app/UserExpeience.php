<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExpeience extends Model
{
    //
    protected $table = 'user_experience';
    public function GetCompanyInfo()
    {
        return $this->belongsTo('App\Company','company_id');
    }
}
