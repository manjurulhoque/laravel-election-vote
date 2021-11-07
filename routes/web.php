<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('visions', App\Http\Controllers\VisionController::class)->except(['destroy']);

Route::get('/register-portal', [App\Http\Controllers\HomeController::class, 'register_portal'])->name('register.portal');
Route::get('/voter-register-portal', [App\Http\Controllers\HomeController::class, 'voter_register_portal'])->name('voter.register.portal');
Route::post('/register-portal', [App\Http\Controllers\HomeController::class, 'register_submit'])->name('register.submit');
Route::get('/candidate-register-portal', [App\Http\Controllers\HomeController::class, 'candidate_register_portal'])->name('candidate.register.portal');
Route::get('/party-register-portal', [App\Http\Controllers\HomeController::class, 'party_register_portal'])->name('party.register.portal');
