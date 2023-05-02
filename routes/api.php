<?php

use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/projects', [ProjectController::class, 'getProjects']);
Route::get('/project-categories', [ProjectCategoryController::class, 'getProjectCategories']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/project-categories')->group(function () {
        Route::post('/create', [ProjectCategoryController::class, 'postCreateProjectCategory']);
        Route::post('/update', [ProjectCategoryController::class, 'postEditProjectCategory']);
        Route::post('/delete', [ProjectCategoryController::class, 'postDeleteProjectCategory']);
    });

    Route::prefix('/projects')->group(function () {
        Route::post('/update-order', [ProjectController::class, 'postUpdateProjectOrder']);
        Route::post('/delete', [ProjectController::class, 'postDeleteProject']);
    });
});
