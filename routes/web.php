<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\CommentaireController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

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
    Route::resource('categories', CategorieController::class);
    Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
    Route::put('/commentaires/{id}', [CommentaireController::class, 'update'])->name('commentaires.update');
    Route::delete('/commentaires/{id}', [CommentaireController::class, 'destroy'])->name('commentaires.destroy');
    Route::get('/recettes/search', [RecetteController::class, 'search'])->name('recettes.search');
    Route::resource('recettes', RecetteController::class);


});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


