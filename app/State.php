<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    public function measurements()
    {
        return $this->hasMany('App\Measurement');
    }
    //
}
