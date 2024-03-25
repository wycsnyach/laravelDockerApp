<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthenticationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserAuthenticationController::class, 'register']);
Route::post('login', [UserAuthenticationController::class, 'login']);


Route::post('logout', [UserAuthenticationController::class, 'logout'])->middleware('auth:sanctum');
Route::get('view-users', [UserAuthenticationController::class, 'index']);
Route::get('search-users/{name}',[UserAuthenticationController::class, 'search']);
Route::post('update-users/{user}',[UserAuthenticationController::class, 'update']);
Route::get('total-users', [UserAuthenticationController::class, 'users_count']);
Route::get('active-users', [UserAuthenticationController::class, 'total_active_users']);
Route::get('inactive-users', [UserAuthenticationController::class, 'total_inactive_users']);

