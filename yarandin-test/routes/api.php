<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
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

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => '/projects'], function() {
        Route::get('/', [ProjectController::class, 'index'])->name('api.projects.index');
        Route::post('/', [ProjectController::class, 'store'])->name('api.projects.index');
        Route::get('/{id}', [ProjectController::class, 'show'])->name('api.projects.show');
        Route::patch('/{id}', [ProjectController::class, 'update'])->name('api.projects.update');
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('api.projects.destroy');
    });

    Route::group(['prefix' => '/tasks'], function() {
        Route::get('/', [TaskController::class, 'index'])->name('api.tasks.index');
        Route::post('/', [TaskController::class, 'store'])->name('api.tasks.store');
        Route::get('/{id}', [TaskController::class, 'show'])->name('api.tasks.show');
        Route::patch('/{id}', [TaskController::class, 'update'])->name('api.tasks.update');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('api.tasks.destroy');
    });
});
