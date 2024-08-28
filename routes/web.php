<?php

use App\Models\Atm;
use App\Models\Client;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('atm/{id}', 
  function ($id){

        return view('atm',["atm"=>Atm::with('bank')->findOrFail($id)]);
  }
)->name('atm');

Route::view('gerador/{id}', 'gerador')->name('gerador');
Route::get('authpi/{id}/{atm}', function($id,$atm){

    $Client= Client::find($id);
     
    if($Client)
    {
        return view('authbank',compact('id','atm'));
    }else{
          return redirect()->back()->with('error','Este cartão é inválido!');
    }
  
})->name('authpi');
Route::view('gerarQrCode', 'gerar-qrcode')->name('gerar-qrcode')->middleware(['auth', 'verified']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
