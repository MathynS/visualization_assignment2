<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pollution extends Model
{
    //
    public function measurement()
    {
        return $this->hasMany('App\Measurement');
    }

}
