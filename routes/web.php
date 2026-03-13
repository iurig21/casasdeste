<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrochureDownloadController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/projeto', function () {
    return view('projeto');
});

Route::get('/acabamentos', function () {
    return view('acabamentos');
});

Route::middleware(['throttle:api'])->group(function () {
    Route::post('/brochure-download', [BrochureDownloadController::class, 'store'])->name('brochure.download');
    Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');
});


Route::get('/admin', [AdminController::class, 'loginForm']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::delete('/admin/downloads/{download}', [AdminController::class, 'destroy']);
    Route::get('/admin/logout', [AdminController::class, 'logout']);
});