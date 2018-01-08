<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function pollution()
    {
        return $this->belongsTo('App\Pollution');
    }

    public function county()
    {
    	return $this->belongsTo('App\county');
    }

}
