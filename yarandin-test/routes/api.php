<?php

use App\Http\Controllers\Api\ProjectController;
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
        Route::get('/', [ProjectController::class, 'index']);
        Route::post('/', [ProjectController::class, 'store']);
        // Route::get('/{id}', [ProjectController::class, 'show']);
        // Route::patch('/{id}', [ProjectController::class, 'update']);
        // Route::delete('/{id}', [ProjectController::class, 'destroy']);
    });
});
