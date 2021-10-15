<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Airport;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
