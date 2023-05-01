<?php

namespace App\Facades;

use App\Services\ProjectCategoryService as ServicesProjectCategoryService;

class ProjectCategoryService extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ServicesProjectCategoryService::class;
    }
}
