<?php

namespace App\Http\Controllers;

use App\Models\City;

class SearchByCityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $cityName
     * @return array
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
