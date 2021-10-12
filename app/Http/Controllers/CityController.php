<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function create()
    {
        return view('city-create');
    }

    public function store()
    {
        return 'test';
    }
}
