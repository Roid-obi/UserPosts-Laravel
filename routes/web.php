<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\{Route, Auth};

Auth::routes(['verify' => true]);

Route::get('/home', HomeController::class)->name('home');
Route::get('/', HomeController::class)->name('welcome');
Route::get('verify/{token}', 'VerificationController@verify')->name('verify')->middleware('verified');

Route::get('/update/users/{id}',[UpdateUserController::class, 'edit'])->name('edit');
Route::post('/update/users/submit',[UpdateUserController::class, 'update']);


// user
Route::get('alluser',[userController::class, 'alluser'])->name('alluser');
Route::delete('alluser/{id}',[userController::class, 'destory'])-> name('alluser.destory');




Route::prefix('my-profile')->middleware(['auth', 'signed'])->group(function() {
    Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
    Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
});