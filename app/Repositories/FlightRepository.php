<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FlightRepository
{
    /**
     * Get flights
     *
     * @param $fromCityName
     * @param $toCityName
     * @return array
     */
    public function getFlights($fromCityName, $toCityName)
    {
        $fromCity = DB::table('cities')
            ->join('airports', 'cities.name', '=', 'airports.city')
            ->where('cities.name', $fromCityName)
            ->get();

        $toCity = DB::table('cities')
            ->join('airports', 'cities.name', '=', 'airports.city')
            ->where('cities.name', $toCityName)
            ->get();

        $airportNames = [];

        $sourceAirport = [];
        foreach ($fromCity as $from) {
            $sourceAirport[] = $from->iata;
            $airportNames[$from->iata] = $from->name;
        }

        $destinationAirport = [];
        foreach ($toCity as $to) {
            $destinationAirport[] = $to->iata;
            $airportNames[$to->iata] = $to->name;
        }

        $routes = DB::table('cities')
            ->select([
                'routes.source_airport',
                'routes.destination_airport',
                'routes.price',
                'routes.stops',
            ])
            ->join('airports', 'cities.name', '=', 'airports.city')
            ->join('routes', 'airports.iata', '=', 'routes.source_airport')
            ->whereIn('cities.name', [$fromCityName, $toCityName])
            ->whereIn('routes.source_airport', $sourceAirport)
            ->whereIn('routes.destination_airport', $destinationAirport)
            ->get();

        return [$routes, $airportNames];
    }
}
