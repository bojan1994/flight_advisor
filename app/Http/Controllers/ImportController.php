<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Airport;
use App\Models\Route;
use App\Services\ImportService;

class ImportController extends Controller
{
    /**
     * @var ImportService
     */
    public $importService;

    /**
     * @param ImportService $importService
     */
    public function __construct(ImportService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke()
    {
        $this->importService->import();

        notify()->success('Airports and routes successfully imported');

        return back();
    }
}
