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
            $measurement1 = new Measurement(array("county" => $entry["County"],"county_code" => $entry['County Code'], "date" => $entry['Date Local'] . "-01", "mean" => $entry['NO2 Mean'], "max" => $entry['NO2 1st Max Value']));
            $measurement1->state()->associate($state);
            $measurement1->pollution()->associate(1);
            $measurement1->save();
            $measurement2 = new Measurement(array("county" => $entry["County"],"county_code" => $entry['County Code'], "date" => $entry['Date Local'] . "-01", "mean" => $entry['O3 Mean'], "max" => $entry['O3 1st Max Value']));
            $measurement2->state()->associate($state);
            $measurement2->pollution()->associate(2);
            $measurement2->save();
            $measurement3 = new Measurement(array("county" => $entry["County"],"county_code" => $entry['County Code'], "date" => $entry['Date Local'] . "-01", "mean" => $entry['SO2 Mean'], "max" => $entry['SO2 1st Max Value']));
            $measurement3->state()->associate($state);
            $measurement3->pollution()->associate(3);
            $measurement3->save();
            $measurement4 = new Measurement(array("county" => $entry["County"],"county_code" => $entry['County Code'], "date" => $entry['Date Local'] . "-01", "mean" => $entry['CO Mean'], "max" => $entry['CO 1st Max Value']));
            $measurement4->state()->associate($state);
            $measurement4->pollution()->associate(4);
            $measurement4->save();
        }

        // $this->call(UsersTableSeeder::class);
    }
}
