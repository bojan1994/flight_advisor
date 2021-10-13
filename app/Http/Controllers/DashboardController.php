<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Airport;

class DashboardController extends Controller
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
        $airports = Airport::get();

        return view('dashboard', [
            'cities' => $cities,
            'airports' => $airports,
        ]);
    }
}
