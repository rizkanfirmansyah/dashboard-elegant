<?php

use App\Http\Controllers\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::prefix('master')->group(function () {
        Route::post('category', [CategoryController::class, 'insert']);
        Route::post('category/update', [CategoryController::class, 'update']);
        Route::get('category', [CategoryController::class, 'get']);
        Route::get('category/{id}', [CategoryController::class, 'get_by_id']);
    });
});
