<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Airport;

class ImportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $cities = City::get();

        $file = fopen(database_path('/data/airports.txt'), "r");

        while(!feof($file)) { 
            $data = explode(",", fgets($file));

            foreach ($cities as $city) {
                if (isset($data[2])) {
                    if ($city->name == trim($data[2], '"') && $city->country == trim($data[3], '"')) {
                        Airport::updateOrCreate([
                            'airport_id' => $data[0],
                        ], [
                            'airport_id' => $data[0],
                            'name' => trim($data[1], '"'),
                            'city' => trim($data[2], '"'),
                            'country' => trim($data[3], '"'),
                            'iata' => $data[4] != '\N' ? trim($data[4], '"') : null,
                            'icao' => $data[5] != '\N' ? trim($data[5], '"') : null,
                            'latitude' => $data[6],
                            'longitude' => $data[7],
                            'altitude' => $data[8],
                            'timezone' => $data[9],
                            'dst' => trim($data[10], '"'),
                            'tz' => trim($data[11], '"'),
                            'type' => trim($data[12], '"'),
                            'source' => trim($data[13], '"'),
                        ]);
                    }
                }
            }
        }

        fclose($file);

        notify()->success('Airports successfully imported');

        return back();
    }
}
