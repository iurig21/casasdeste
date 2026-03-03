<?php

use App\Http\Controllers\BrochureDownloadController;
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

Route::post('/brochure-download', [BrochureDownloadController::class, 'store'])->name('brochure.download');







