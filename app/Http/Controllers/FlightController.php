<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Services\FlightService;

class FlightController extends Controller
{
    /**
     * @var FlightService
     */
    public $flightService;

    /**
     * @param FlightService $flightService
     */
    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    /**
     * Return flight index view
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cities = City::get();

        return view('flight-index', ['cities' => $cities]);
    }

    /**
     * Get flights
     *
     * @param $fromCityName
     * @param $toCityName
     * @return array
     */
    public function getFlights($fromCityName, $toCityName)
    {
        return [
            'html' => view('filtered-routes', [
                'routes' => $this->flightService->getFlights($fromCityName, $toCityName)[0],
                'airportNames' => $this->flightService->getFlights($fromCityName, $toCityName)[1],
            ])->render(),
        ];
    }
}
