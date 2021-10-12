<?php

namespace App\Http\Controllers;

use App\Models\City;

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

        return view('dashboard', ['cities' => $cities]);
    }
}
