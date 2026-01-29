<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('recettes.index');
// });

// Route::resource('recettes', RecetteController::class);
// Route::get('/register',[AuthController::class,'registerForm']);
// Route::get('/login',[AuthController::class,'loginForm']);


Route::middleware('guest')->group(function(){

    Route::get('/login',[AuthController::class,'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register',[AuthController::class, 'registerForm'])->name('register');
    Route::post('/register',[AuthController::class , 'register']);

});

Route::middleware('auth')->group(function(){
    Route::resource('recettes', RecetteController::class);
        Route::resource('categories', CategorieController::class);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
