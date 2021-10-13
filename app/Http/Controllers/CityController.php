<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Models\City;

class CityController extends Controller
{
    public function create()
    {
        return view('city-create');
    }

    public function store(StoreCityRequest $request)
    {
        City::create($request->all());

        notify()->success('City successfully created');

        return redirect()->route('dashboard');
    }
}
