<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/candidates', [App\Http\Controllers\HomeController::class, 'candidates'])->name('candidates.list');
Route::get('/candidates/{id}', [App\Http\Controllers\CandidateController::class, 'show'])->name('candidates.view');
Route::get('/candidate-profile', [App\Http\Controllers\CandidateController::class, 'profile'])->name('candidate.profile');
Route::get('/candidate-profile-edit', [App\Http\Controllers\CandidateController::class, 'edit'])->name('candidate.profile.edit');
Route::put('/candidate-profile-edit', [App\Http\Controllers\CandidateController::class, 'update'])->name('candidate.profile.update');
Route::resource('visions', App\Http\Controllers\VisionController::class)->except(['destroy']);

Route::get('/register-portal', [App\Http\Controllers\HomeController::class, 'register_portal'])->name('register.portal');
Route::get('/voter-register-portal', [App\Http\Controllers\HomeController::class, 'voter_register_portal'])->name('voter.register.portal');
Route::post('/register-portal', [App\Http\Controllers\HomeController::class, 'register_submit'])->name('register.submit');
Route::get('/candidate-register-portal', [App\Http\Controllers\HomeController::class, 'candidate_register_portal'])->name('candidate.register.portal');
Route::get('/party-register-portal', [App\Http\Controllers\HomeController::class, 'party_register_portal'])->name('party.register.portal');

Route::resource('posts', App\Http\Controllers\PostController::class);
Route::resource('comments', App\Http\Controllers\CommentController::class)->only(['store']);
