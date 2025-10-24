<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/users',[userController::class,'index']) ->name('users.index');



// Route::get('/users', [userController::class, 'index'])->name('users.index');


// Route:: get('/users/create',[userController::class , 'create']) -> name('users.create');


// Route::post('/users',[userController::class,'store']) ->name('users.store');


// Route::get('/users/{id}/edit',[userController::class , 'edit']) ->name('users.edit');

// Route::put('/users/{id}',[userController::class , 'update'])->name('users.update'); 

// Route::get('/users/{id}', [userController::class, 'show']) ->name('users.show');


// Route::delete('/users/{id}',[userController::class , 'destroy'])->name('users.destroy');

Route::resource('users', UserController::class);


