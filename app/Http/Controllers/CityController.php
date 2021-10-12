<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function create()
    {
        return view('city-create');
    }

    public function store(Request $request)
    {
        City::create($request->all());

        return redirect()->route('dashboard');
    }
}
