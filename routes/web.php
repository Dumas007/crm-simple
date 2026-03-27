<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas GET
Route::get('/api/login-get', [AuthController::class, 'loginGet']);
Route::get('/api/leads', [LeadController::class, 'index']);

// Rutas POST sin CSRF
Route::post('/api/leads', [LeadController::class, 'store'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::put('/api/leads/{id}', [LeadController::class, 'update'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::delete('/api/leads/{id}', [LeadController::class, 'destroy'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);