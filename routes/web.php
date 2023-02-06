<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UpdateUserController;
use Illuminate\Support\Facades\{Route, Auth};

Auth::routes(['verify' => true]);

Route::get('/home', HomeController::class)->name('home');
Route::get('/', HomeController::class)->name('welcome');
Route::get('verify/{token}', 'VerificationController@verify')->name('verify')->middleware('verified');

Route::get('/update/users/{id}',[UpdateUserController::class, 'edit'])->name('edit');
Route::post('/update/users/submit',[UpdateUserController::class, 'update']);