<?php

use App\Http\Controllers\ViewController;
use Illuminate\Routing\RouteGroup;
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

Route::get('/', [ViewController::class, "home"])->name('dashboard');
Route::get('/auth/login', [ViewController::class, "login"]);
Route::get('/auth/register', [ViewController::class, "register"]);


Route::prefix('master')->group(function () {
    Route::get('/category', [ViewController::class, "category"]);
});
