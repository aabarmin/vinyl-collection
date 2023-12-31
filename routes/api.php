<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\AdminAuthenticate;
use Illuminate\Support\Facades\Route;

Route::controller(FileController::class)->group(function () {
    Route::post('/files', 'create');
    Route::get('/files/{fileType}/{filePath}', 'findOne');
});

Route::controller(ServiceController::class)->group(function () {
    Route::middleware([AdminAuthenticate::class])->group(function () {
        Route::get('/admin/migrate', 'migrate');
        Route::delete('/admin/cleanup', 'cleanup');
    });
});
