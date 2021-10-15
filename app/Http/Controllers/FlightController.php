<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;
use App\Models\Route;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function index()
    {
        $cities = City::get();

        return view('flight-index', ['cities' => $cities]);
    }

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

        return [
            'html' => view('filtered-routes', [
                'routes' => $routes,
                'airportNames' => $airportNames,
            ])->render(),
        ];
    }
}
