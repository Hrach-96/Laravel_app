<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    //
    protected $table = 'token';

    const status_active = 0;
    const status_inactive  = 1;

    public function GetUser()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
