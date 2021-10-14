<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'iata',
        'airline_id',
        'source_airport',
        'source_airport_id',
        'destination_airport',
        'destination_airport_id',
        'codeshare',
        'stops',
        'equipment',
        'price',
    ];
}
