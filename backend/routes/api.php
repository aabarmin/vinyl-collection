<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\VinylController;
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

Route::controller(VinylController::class)->group(function () {
    Route::get('/vinyls', 'viewAll');
    Route::post('/vinyls', 'create');
    Route::get('/vinyls/{vinyl}', 'findOne');
    Route::put('/vinyls/{vinyl}', 'updateOne');
});

Route::controller(FileController::class)->group(function () {
    Route::post('/files', 'create');
    Route::get('/files/{fileType}/{filePath}', 'findOne');
});