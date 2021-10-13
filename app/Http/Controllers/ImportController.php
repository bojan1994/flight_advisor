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

        $f = fopen(database_path('/data/airports.txt'), "r");

        while(!feof($f)) { 
            $data = explode(",", fgets($f));

            foreach ($cities as $city) {
                if (isset($data[2])) {
                    if ($city->name == trim($data[2], '"') && $city->country == trim($data[3], '"')) {
                        Airport::create([
                            'id' => $data[0],
                            'name' => $data[1],
                            'city' => $data[2],
                            'country' => $data[3],
                            'iata' => $data[4],
                            'icao' => $data[5],
                            'latitude' => $data[6],
                            'longitude' => $data[7],
                            'altitude' => $data[8],
                            'timezone' => $data[9],
                            'dst' => $data[10],
                            'tz' => $data[11],
                            'type' => $data[12],
                            'source' => $data[13],
                        ]);
                    }
                }
            }
        }

        fclose($f);

        return back();
    }
}
