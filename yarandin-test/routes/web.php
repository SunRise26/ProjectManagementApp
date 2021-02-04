<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Web\TaskController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

Route::get('/', function () {
    return redirect('register');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::group(['prefix' => '/project'], function () {
        Route::get('/{id}/details', [ProjectController::class, 'index'])->name('user.project_details');
        Route::get('/create', [ProjectController::class, 'create'])->name('user.project_create');
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('user.project_edit');
    });

    Route::group(['prefix' => '/task'], function () {
        Route::get('/create', [TaskController::class, 'create'])->name('user.task_create');
        Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('user.task_edit');
        Route::get('/{id}/attachment', [TaskController::class, 'taskAttachment'])->name('user.task_attachment');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

require __DIR__.'/auth.php';
