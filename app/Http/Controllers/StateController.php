<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{

    public function cache_retrieve()
    {
        $path = storage_path() . "/json/states.json";
        return json_decode(file_get_contents($path), true);
    }

    public function retrieve()
    {
        $response = array();
        $state_codes = State::get();
        foreach ($state_codes as $state_code)
        {
            $values = $state_code->measurements()->get();
            if (empty($values)) {
                continue;
            }
            foreach ($values as $value) {
                $type = $value->pollution()->first();
                if (array_key_exists($state_code->code, $response)){
                    if (array_key_exists($type->name, $response[$state_code->code])) {
                        $response[$state_code->code][$type->name][$value->date] = $value;
                    }
                    else {
                        $response[$state_code->code][$type->name] = array($value->date => $value);
                    }
                }
                else {
                    $response[$state_code->code] = array($type->name => array($value->date => $value));
                }
            }
        }
        return $response;
    }


}
