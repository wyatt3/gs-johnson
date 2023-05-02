<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', [Controller::class, 'index'])->name('home');

Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/', [Controller::class, 'adminIndex'])->name('admin');
    Route::get('/project-categories', [ProjectCategoryController::class, 'getProjectCategoriesInterface'])->name('admin.project-categories.index');

    Route::prefix('/projects')->group(function () {
        Route::get('/', [ProjectController::class, 'getProjectsInterface'])->name('admin.projects.index');
        Route::get('/create', [ProjectController::class, 'getCreateProject'])->name('admin.projects.create');
        Route::post('/create', [ProjectController::class, 'postCreateProject'])->name('admin.projects.store');
        Route::get('/edit/{id}', [ProjectController::class, 'getEditProject'])->name('admin.projects.edit');
        Route::post('/update', [ProjectController::class, 'postEditProject'])->name('admin.projects.update');
        Route::get('/{id}', [ProjectController::class, 'getProject'])->name('admin.project.get');
    });
});
