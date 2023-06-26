<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NamatokoController;
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


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');


Route::middleware(['auth:sanctum', 'ability:check-status,place-orders'])->group(
    function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::post('/getuserdata', [LoginController::class, 'getuserdata']);
        Route::prefix('/namatoko')->controller(NamatokoController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{namatoko}', 'show');
            Route::put('/{namatoko}', 'update');
            Route::delete('/{namatoko}', 'destroy');
        });
    }
    // Route::resource('/namatoko', NamatokoController::class, ['except' => ['create']]);
);
