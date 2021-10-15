<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Return create view
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('city-create');
    }

    /**
     * Store city
     *
     * @param StoreCityRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCityRequest $request)
    {
        City::create($request->all());

        notify()->success('City successfully created');

        return redirect()->route('dashboard');
    }
}
