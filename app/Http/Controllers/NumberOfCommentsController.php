<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class NumberOfCommentsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
