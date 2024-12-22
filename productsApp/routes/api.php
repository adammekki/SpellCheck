<?php

use App\Http\Controllers\Api\productsController;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/// USER APIS ///

Route::get('/users',[productsController::class,'indexUsers']);
Route::get('/users/{username}',[productsController::class,'showUsers']);
Route::post('/users',[productsController::class,'storeUsers']);
Route::put('/users/{username}',[productsController::class,'updateUsers']);
Route::delete('/users/{id}',[productsController::class,'destroyUsers']);
Route::post('/login', [productsController::class, 'login']);
/// SCORE APIS /// make sure the names of the functions are correct 

Route::get('/scores',[productsController::class,'indexScores']);
Route::get('/scores/{username}',[productsController::class,'showScores']);
Route::post('/scores',[productsController::class,'storeScores']);
Route::put('/scores/{username}',[productsController::class,'updateScores']);
Route::delete('/scores/{username}',[productsController::class,'destroyScores']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
