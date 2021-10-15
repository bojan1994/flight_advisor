<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;
use App\Models\Route;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function index()
    {
        // $airportsFile = fopen(database_path('/data/airports.txt'), "r");
        // $routesFile = fopen(database_path('/data/routes.txt'), "r");

        // while (!feof($airportsFile)) { 
        //     $data = explode(",", fgets($airportsFile));

        //     print_r($data);

        //     echo '<br>';
        // }

        // die();

        $airports = Airport::get();

        return view('flight-index', ['airports' => $airports]);
    }

    public function getFlights($sourceAirportId, $destinationAirportId)
    {
        $routes = Route::where('source_airport_id', $sourceAirportId)
            ->where('destination_airport_id', $destinationAirportId)
            ->get();

        // $routes = DB::table('routes')
        //     ->select([
        //         'routes.source_airport_id'
        //     ])
        //     ->join('airports', function ($join) {
        //         $join->on('routes.source_airport_id', '=', 'airports.airport_id');
        //     })
        //     ->where('routes.source_airport_id', '=', $sourceAirportId)
        //     ->where('routes.destination_airport_id', '=', $destinationAirportId)
        //     ->get();

        // return $routes;

        return [
            'html' => view('filtered-routes', [
                'routes' => $routes,
            ])->render(),
        ];
    }
}
