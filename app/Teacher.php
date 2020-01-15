<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function classlists()
    {
        //return $this->hasMany('App\Classlist');
    }
}
