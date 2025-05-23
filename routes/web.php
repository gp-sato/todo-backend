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
Route::middleware('web', 'auth:sanctum')->post('/logout', function (Request $request) {
    Auth::guard('web')->logout(); // セッションクリア
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return response()->json(['message' => 'logged out']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
