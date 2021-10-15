<?php

namespace App\Http\Controllers;

use App\Models\City;

class NumberOfCommentsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $cityId
     * @param $limit
     * @return array
     */
    public function __invoke($cityId, $limit)
    {
        $city = City::where('id', $cityId)->first();

        return [
            'html' => view('filtered-comments', [
                'comments' => $city->comment()->limit($limit)->get(),
            ])->render(),
        ];
    }
}
