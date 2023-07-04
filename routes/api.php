<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NamatokoController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\VarianController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register');


Route::middleware('auth:sanctum')->group(
    function () {
        Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('/getuserdata', [AuthController::class, 'getuserdata']);
        Route::put('/auth/update/{user}', [AuthController::class, 'update']);
        Route::resource('/namatoko', NamatokoController::class, ['create']);
        Route::resource('/menu', MenuController::class, ['create']);
        Route::resource('/varian', VarianController::class, ['create']);
        Route::resource('/harga', HargaController::class, ['create']);
        Route::resource('/picture', PictureController::class, ['create']);
    }

);
