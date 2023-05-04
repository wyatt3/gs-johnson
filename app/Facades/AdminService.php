<?php

namespace App\Facades;

use App\Services\AdminService as ServicesAdminService;

class AdminService extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ServicesAdminService::class;
    }
}
