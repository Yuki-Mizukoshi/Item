<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/detail/{id}', [App\Http\Controllers\ItemController::class, 'detail']);
    // 管理者ユーザーのみ
    Route::group(['middleware' => ['auth', 'can:admin']], function () {
        Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
        Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
        Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
        Route::post('/update/{id}', [App\Http\Controllers\ItemController::class, 'update']);
        Route::post('/delete/{id}', [App\Http\Controllers\ItemController::class, 'delete']);
    });
    });



Route::prefix('users')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/update/{id}', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);
    // 管理者ユーザーのみ
    Route::group(['middleware' => ['auth', 'can:admin']], function () {
        Route::get('/add', [App\Http\Controllers\UserController::class, 'add']);
        Route::post('/create', [App\Http\Controllers\UserController::class, 'create']);
    });
});



