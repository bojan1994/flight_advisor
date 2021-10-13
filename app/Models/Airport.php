<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'city',
        'country',
        'iata',
        'icao',
        'latitude',
        'longitude',
        'altitude',
        'timezone',
        'dst',
        'tz',
        'type',
        'source',
    ];
}
