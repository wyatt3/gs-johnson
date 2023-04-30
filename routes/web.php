<?php

use App\Http\Controllers\Controller;
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

    Route::prefix('/projects')->group(function () {
        Route::get('/', [ProjectController::class, 'getProjects'])->name('admin.projects');
        Route::get('/create', [ProjectController::class, 'getCreateProject'])->name('admin.projects.create');
        Route::post('/create', [ProjectController::class, 'postCreateProject'])->name('admin.projects.store');
        Route::get('/edit/{id}', [ProjectController::class, 'getEditProject'])->name('admin.projects.edit');
        Route::post('/update', [ProjectController::class, 'postEditProject'])->name('admin.projects.update');
        Route::post('/delete', [ProjectController::class, 'postDeleteProject'])->name('admin.projects.delete');
        Route::get('/{id}', [ProjectController::class, 'getProject'])->name('admin.project.get');
    });

    Route::prefix('/project-categories')->group(function () {
        Route::get('/', [ProjectController::class, 'getProjectCategories'])->name('admin.project-categories');
        Route::get('/create', [ProjectController::class, 'getCreateProjectCategory'])->name('admin.project-categories.create');
        Route::post('/create', [ProjectController::class, 'postCreateProjectCategory'])->name('admin.project-categories.store');
        Route::get('/edit/{id}', [ProjectController::class, 'getEditProjectCategory'])->name('admin.project-categories.edit');
        Route::post('/update', [ProjectController::class, 'postEditProjectCategory'])->name('admin.project-categories.update');
        Route::post('/delete', [ProjectController::class, 'postDeleteProjectCategory'])->name('admin.project-categories.delete');
    });
});
