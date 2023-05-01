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
        Route::post('/create', [ProjectCategoryController::class, 'postCreateProjectCategory'])->name('admin.project-categories.store');
        Route::post('/update', [ProjectCategoryController::class, 'postEditProjectCategory'])->name('admin.project-categories.update');
        Route::post('/delete', [ProjectCategoryController::class, 'postDeleteProjectCategory'])->name('admin.project-categories.delete');
    });
});
