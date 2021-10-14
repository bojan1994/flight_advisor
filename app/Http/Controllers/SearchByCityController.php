<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class SearchByCityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($cityName)
    {
        $cities = City::where('name', 'like', '%' . $cityName . '%')
            ->get();

        return [
            'html' => view('filtered-cities', [
                'cities' => $cities,
            ])->render(),
        ];
    }
}
