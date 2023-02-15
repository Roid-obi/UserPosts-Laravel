<?php

use App\Http\Controllers\alluController;
use App\Http\Controllers\DetailUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\userController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController as ControllersUserController;
use App\Http\Controllers\welcome;
use Illuminate\Support\Facades\{Route, Auth};

Auth::routes(['verify' => true]);

Route::get('/home', HomeController::class)->name('home');
Route::get('/', welcome::class)->name('welcome');
Route::get('verify/{token}', 'VerificationController@verify')->name('verify')->middleware('verified');

Route::get('/update/users/{id}',[UpdateUserController::class, 'edit'])->name('edit');
Route::post('/update/users/submit',[UpdateUserController::class, 'update']);


// user
// Route::get('alluser',[alluController::class, 'alluser'])->name('alluser');
// Route::delete('alluser/{id}',[alluController::class, 'destory'])-> name('alluser.destory');




Route::prefix('my-profile')->middleware(['auth', 'signed'])->group(function() {
    Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
    Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
});


// untuk slas user / halaman daftar user
Route::prefix('user')->middleware('roleCek')->group(function() {
    Route::controller(UserController::class)->group(function () {
        Route::get('/list',  'list')->name('user.list');
        Route::get('/',  'index')->name('user.index');
        Route::delete('/delete/{user}', 'destroy')->name('destroy');
        
    });
});


// untuk detail user
Route::get('/show/{id}',[DetailUserController::class, 'show'])->name('show');
Route::put('/show/{id}',[DetailUserController::class, 'update'])->name('show.update');


// halaman tag
Route::prefix('tag')->group(function() {
    Route::controller(TagController::class)->group(function () {
        Route::get('/',  'index')->name('tag.index');
        Route::get('/tag',  'list')->name('tag.list');
        Route::get('/create', 'create')->name('tag.create'); //mengarah ke halaman tag create
        Route::put('/', 'store')->name('tag.input'); //input tag
        Route::get('/{tag}', 'edit')->name('tag.edit'); 
        Route::put('/{tag}', 'update')->name('user.update');
        Route::delete('/{tag}', 'destroy')->name('tag.destroy');
    });
});
// Route::prefix('tag')->controller(TagController::class)->group(function() {
    

//         Route::get('/', 'list')->name('tag.list');
//         Route::get('/create',  'create')->name('tag.create');
//         Route::put('/create',  'store')->name('tag.store');
// });
