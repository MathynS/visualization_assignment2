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
            $values = $state_code->measurements()->where('date', '<=', '2000-01-10')->get(['max', 'mean', 'date']);
            if (empty($values)) {
                continue;
            }
            foreach ($values as $value) {
                if (array_key_exists($state_code->code, $response)){
                    $response[$state_code->code][$value->date] = $value;
                }
                else {
                    $response[$state_code->code] = array($value->date => $value);
                }
            }
        }
        return $response;
    }


}
