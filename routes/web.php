<?php

use App\Http\Controllers\alluController;
use App\Http\Controllers\DetailUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\userController;
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
Route::get('alluser',[alluController::class, 'alluser'])->name('alluser');
Route::delete('alluser/{id}',[alluController::class, 'destory'])-> name('alluser.destory');




Route::prefix('my-profile')->middleware(['auth', 'signed'])->group(function() {
    Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
    Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
});

// untuk slas user 
Route::prefix('user')->middleware('roleCek')->group(function() {
    Route::controller(UserController::class)->group(function () {
        Route::get('/list',  'list')->name('user.list');
        Route::get('/',  'index')->name('user.index');
        Route::delete('/delete/{user}', 'destroy')->name('destroy');
        
    });
});


Route::get('/show/{id}', [DetailUserController::class, 'show'] )-> name('show');



