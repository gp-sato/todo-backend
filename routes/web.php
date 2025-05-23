<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);
Route::middleware('auth:sanctum')->post('/logout', function () {
    Auth::logout();
    return response()->noContent();
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
