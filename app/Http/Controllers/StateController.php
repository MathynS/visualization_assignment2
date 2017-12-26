<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{

    public function retrieve()
    {
        $response = array();
        $state_codes = State::get();
        foreach ($state_codes as $state_code)
        {
            $response[$state_code->code] = $state_code->measurements()->first(['max', 'mean']);
        }
        return $response;
    }


}
