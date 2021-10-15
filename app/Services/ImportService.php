<?php

namespace App\Services;

use App\Repositories\ImportRepository;

class ImportService
{
    /**
     * @var ImportRepository
     */
    public $importRepository;

    /**
     * @param ImportRepository $importRepository
     */
    public function __construct(ImportRepository $importRepository)
    {
        $this->importRepository = $importRepository;
    }

    /**
     * Import airports and routes
     */
    public function import()
    {
        $this->importRepository->import();
    }
}
