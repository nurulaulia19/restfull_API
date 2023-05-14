<?php


// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MahasiswaController;
// use App\Http\Controllers\API\AuthController;

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
    return view('welcome');
});

// Route::post('/register', [AuthController::class, 'index']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::group(['middleware' => ['auth:sanctum']], function(){
    
//     Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
//     Route::get('/mahasiswa/show/{id}', [MahasiswaController::class, 'show']);
//     Route::delete('/mahasiswa/destroy/{id}', [MahasiswaController::class, 'destroy']);
//     Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
//     Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update']);
//     Route::post('/logout', [AuthController::class, 'logout']);

// });