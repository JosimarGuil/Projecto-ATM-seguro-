<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('atm/{id}', 'atm')->name('atm');
Route::view('gerador/{id}', 'gerador')->name('gerador');
Route::view('gerarQrCode', 'gerar-qrcode')->name('gerar-qrcode')->middleware(['auth', 'verified']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
