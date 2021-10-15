<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Airport;
use App\Models\Route;

class ImportRepository
{
    /**
     * Import airports and routes
     */
    public function import()
    {
        $cities = City::get();

        $airportsFile = fopen(database_path('/data/airports.txt'), "r");
        $routesFile = fopen(database_path('/data/routes.txt'), "r");

        while (!feof($airportsFile)) {
            $data = explode(",", fgets($airportsFile));

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

        $airports = Airport::get();

        while (!feof($routesFile)) {
            $data = explode(",", fgets($routesFile));

            foreach ($airports as $airport) {
                if (isset($data[3])) {
                    if ($data[3] == $airport->airport_id) {
                        Route::updateOrCreate([
                            'source_airport_id' => $data[3],
                            'destination_airport' => $data[4],
                        ], [
                            'iata' => $data[0],
                            'airline_id' => $data[1],
                            'source_airport' => $data[2],
                            'source_airport_id' => $data[3],
                            'destination_airport' => $data[4],
                            'destination_airport_id' => $data[5] != '\N' ? $data[5] : null,
                            'codeshare' => $data[6],
                            'stops' => $data[7],
                            'equipment' => $data[8],
                            'price' => $data[9],
                        ]);
                    }
                }
            }
        }

        fclose($airportsFile);
        fclose($routesFile);
    }
}
