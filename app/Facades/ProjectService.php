<?php

namespace App\Facades;

use App\Services\ProjectService as ServicesProjectService;

class ProjectService extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ServicesProjectService::class;
    }
}
