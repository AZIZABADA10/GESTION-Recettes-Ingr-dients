<?php

use App\Http\Controllers\RecetteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::resource('recettes', RecetteController::class);