<?php

use App\Http\Controllers\CategoryController;
use App\Models\Category;
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

// API <- App Pro Interface

// REST API <- ONLY BACKEND, FRONTEND CONSUME API <- FETCH API
// REST (REpresentational State Transfer) API
// EndPoint <- titik akses yang bisa diguanakan frontend untuk mengambil dan mentraansfer data
// REST API <- salah satu bentuk paling sederhana dalam komunikasi data (mobile/web/desktop/dsb) <- JSON/XML/TXT/BLOB/HTML
// {
//     "name" : "rizkan firmansyah"
// }
// <name>Rizkan Firmansyah</name>
// Laravel + API ? Giman whyyyyy??

Route::prefix('v1')->group(function () {
    // Route::prefix('master')->group(function () {
    Route::get('category', [CategoryController::class, 'get_data']);
    Route::post('category', [CategoryController::class, 'insert']);
    Route::put('category/{id}', [CategoryController::class, 'update']);
    Route::delete('category/{id}', [CategoryController::class, 'delete']);
    Route::get('category/{id}', [CategoryController::class, 'get_by_id']);
    // });
});


//  /api/v2/category/get

// Route::prefix('v2')->group(function () {
//     Route::get('category/get/', function () {
//         try {
//             $data = Category::all();
//             // $data =[
//             //     ''
//             // ]
//         } catch (\Throwable $th) {
//             return response()->json(['message' => $th->getMessage()], 403);
//         }

//         return response()->json($data);
//         // header('application/json');
//         // echo json_encode($data);
//     });

//     Route::post('category', function (Request $request) {
//         // dd($request->all());
//         try {
//             if (!isset($request->name)) { // FALSE NAME
//                 throw new Exception("Name cannot be null");
//             }
//             $data = Category::create($request->all());
//         } catch (\Throwable $th) {
//             return response()->json(['message' => $th->getMessage()], 403);
//         }

//         return response()->json(['message' => 'Input Data Berhasil', 'data' => $data], 200);
//     });
// });
