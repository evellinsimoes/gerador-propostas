<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PropostaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clientes', ClienteController::class);
Route::resource('propostas', PropostaController::class);
Route::get('propostas/{proposta}/pdf', [PropostaController::class, 'gerarPdf'])->name('propostas.pdf');
Route::get('propostas/{proposta}/visualizar', [PropostaController::class, 'visualizarPdf'])->name('propostas.visualizar');