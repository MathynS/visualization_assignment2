<?php

namespace App\Http\Controllers;

use App\State;
use App\Measurement;
use App\Pollution;
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
        $response = array('data' => array(), 'maxima' => array());
        
        foreach (Pollution::get() as $pollution){
            $response['maxima'][$pollution->name] = array('mean' => Measurement::where('id', $pollution->id)->max('mean'));
            $response['maxima'][$pollution->name]['max'] = Measurement::where('id', $pollution->id)->max('max');
        }
        return $response;
        foreach (State::get() as $state_code)
        {
            $values = $state_code->measurements()->get();
            if (empty($values)) {
                continue;
            }
            foreach ($values as $value) {
                $type = $value->pollution()->first();
                if (array_key_exists($state_code->code, $response['data'])){
                    if (array_key_exists($type->name, $response['data'][$state_code->code])) {
                        $response['data'][$state_code->code][$type->name][$value->date] = $value;
                    }
                    else {
                        $response['data'][$state_code->code][$type->name] = array($value->date => $value);
                    }
                }
                else {
                    $response['data'][$state_code->code] = array($type->name => array($value->date => $value));
                }
            }
        }
        return $response;
    }
}
