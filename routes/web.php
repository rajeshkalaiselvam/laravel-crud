<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('index');
// });

Route::resource('/',UserController::class);
Route::get('edit/{id}',[UserController::class,'edit']);

Route::post('Formsubmit',[UserController::class,'store']);
Route::post('updateForm',[UserController::class,'update']);
Route::post('delete',[UserController::class,'delete']);
