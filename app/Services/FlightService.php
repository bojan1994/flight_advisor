<?php

namespace App\Services;

use App\Repositories\FlightRepository;

class FlightService
{
    /**
     * @var FlightRepository
     */
    public $flightRepository;

    /**
     * @param FlightRepository $flightRepository
     */
    public function __construct(FlightRepository $flightRepository)
    {
        $this->flightRepository = $flightRepository;
    }

    /**
     * Get flights
     *
     * @param $fromCityName
     * @param $toCityName
     * @return array
     */
    public function getFlights($fromCityName, $toCityName)
    {
        return $this->flightRepository->getFlights($fromCityName, $toCityName);
    }
}
