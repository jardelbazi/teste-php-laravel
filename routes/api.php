<?php

use App\Http\Controllers\Api\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('categories')->group(function () {
	Route::post('/', [CategoryController::class, 'store']);
	Route::put('/{id}', [CategoryController::class, 'update'])->whereNumber('id');
	Route::get('/{id}', [CategoryController::class, 'show'])->whereNumber('id');
	Route::delete('/{id}', [CategoryController::class, 'destroy'])->whereNumber('id');
	Route::get('/', [CategoryController::class, 'index']);
});
