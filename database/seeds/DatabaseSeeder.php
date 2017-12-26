<?php

use Illuminate\Database\Seeder;
use App\Measurement;
use App\State;

class DatabaseSeeder extends Seeder
{

    public function csv_to_array($filename='', $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    if (sizeof($row) == sizeof($header)){
                        $data[] = array_combine($header, $row);
                    }
            }
            fclose($handle);
        }
        return $data;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = $this->csv_to_array(public_path() . '/csv/states.csv');
        $pollutions = $this->csv_to_array(public_path() . '/csv/pollutions.csv');
        DB::table('states')->insert($states);
        DB::table('pollutions')->insert($pollutions);

        $entries = $this->csv_to_array(public_path() . '/csv/pollution_us_2000_2016.csv');
        foreach ($entries as $entry)
        {
            $state = State::where('name', '=', $entry['State'])->get();
            if (count($state) == 0)
            {
                echo $entry['State'] . "\n";
                continue;
            }
            $state = $state[0]['id'];
            $measurement = new Measurement(array("date" => $entry['Date Local'], "mean" => $entry['NO2 Mean'], "max" => $entry['NO2 1st Max Value']));
            $measurement->state()->associate($state);
//            $measurement->pollution()->associate(1);
            $measurement->save();
        }

        // $this->call(UsersTableSeeder::class);
    }
}
