<?php

namespace App\Facades;

use App\Services\ProjectMediaService as ServicesProjectMediaService;

class ProjectMediaService extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ServicesProjectMediaService::class;
    }
}
