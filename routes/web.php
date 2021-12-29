<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/candidates', [App\Http\Controllers\HomeController::class, 'candidates'])->name('candidates.list');
Route::get('/parties', [App\Http\Controllers\HomeController::class, 'parties'])->name('parties.list');
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
Route::get('our-manifesto', [App\Http\Controllers\ManifestoController::class, 'our_manifesto'])->name('our.manifesto');
Route::get('submit-manifesto', [App\Http\Controllers\ManifestoController::class, 'submit_manifesto'])->name('submit.manifesto');
Route::post('our-manifesto', [App\Http\Controllers\ManifestoController::class, 'store'])->name('store.manifesto');
Route::get('edit-manifesto', [App\Http\Controllers\ManifestoController::class, 'edit'])->name('edit.manifesto');
Route::post('update-manifesto', [App\Http\Controllers\ManifestoController::class, 'update'])->name('update.manifesto');

Route::get('selected-candidates/', [\App\Http\Controllers\PartyCandidateController::class, 'index'])
    ->name('selected.candidates')->middleware(['auth', 'party']);

Route::get('all-candidates-to-select/', [\App\Http\Controllers\PartyCandidateController::class, 'all_candidates_to_select'])
    ->name('all.candidates.to.select')->middleware(['auth', 'party']);

Route::get('select-candidate/{id}', [\App\Http\Controllers\PartyCandidateController::class, 'select_candidate'])
    ->name('select.candidate')->middleware(['auth', 'party']);

Route::get('voters', [\App\Http\Controllers\ElectionCommissionController::class, 'voter_list'])->name('voter.list');
Route::resource('notices', \App\Http\Controllers\NoticeBoardController::class);
Route::resource('elections', \App\Http\Controllers\ElectionController::class);
Route::get('upload-profile-image', [\App\Http\Controllers\HomeController::class, 'upload_profile_image'])->name('upload.profile.image');
Route::put('upload-profile-image', [\App\Http\Controllers\HomeController::class, 'save_profile_image'])->name('store.profile.image');
Route::get('party-profile/{id}', [\App\Http\Controllers\PartyController::class, 'party_profile'])->name('party.profile');
