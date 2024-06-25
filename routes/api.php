<?php


Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::middleware('auth:sanctum')->get('/user', 'App\Http\Controllers\AuthController@user');
Route::middleware('auth:sanctum')->post('/logout', 'App\Http\Controllers\AuthController@logout');

