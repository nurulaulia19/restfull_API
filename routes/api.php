<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\API\AuthController;
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function(){
    
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::get('/mahasiswa/show/{id}', [MahasiswaController::class, 'show']);
    Route::delete('/mahasiswa/destroy/{id}', [MahasiswaController::class, 'destroy']);
    Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
    Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/prodi', [ProdiController::class, 'index']);
    Route::get('/prodi/show/{id}', [ProdiController::class, 'show']);
    Route::delete('/prodi/destroy/{id}', [ProdiController::class, 'destroy']);
    Route::post('/prodi', [ProdiController::class, 'store']);
    Route::put('/prodi/update/{id}', [ProdiController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

});


// use App\Http\Controllers\ProdiController;

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

// Route::get('/mahasiswa', [MahasiswaController::class,'index']);
// Route::get('/mahasiswa/show/{id}', [MahasiswaController::class,'show']);
// Route::delete('/mahasiswa/destroy/{id}', [MahasiswaController::class,'destroy']);
// Route::post('/mahasiswa', [MahasiswaController::class,'store']);
// Route::put('/mahasiswa/update/{id}', [MahasiswaController::class,'update']);

// Route::get('/prodi', [ProdiController::class,'index']);
// Route::get('/prodi/show/{id}', [ProdiController::class,'show']);
// Route::delete('/prodi/destroy/{id}', [prodiController::class,'destroy']);
// Route::post('/prodi', [ProdiController::class,'store']);
// Route::put('/prodi/update/{id}', [ProdiController::class,'update']);


