<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-api', function () {
    return view('test-api');
});

Route::get('/test-score-api', function () {
    return view('test-score-api');
});