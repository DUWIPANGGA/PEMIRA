<?php

use App\Http\Controllers\ElectionsController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('profile',function(){
    return view('profile.index');
})->name('profile');
Route::get('vote', [VoteController::class,'main'])->name('voting');
Route::get('vote/{name}', [VoteController::class,'show'])->name('voting.show');
Route::post ('vote/{name}', [VoteController::class,'create'])->name('voting.create');
Route::resource('hasil', MonitoringController::class);

Route::get('/hasil', function () {
    return view('monitoring');
})->name('hasil');
Route::resource('pemilu',ElectionsController::class);
Route::resource('candidate',TeamController::class);
Route::resource('users',UserController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

