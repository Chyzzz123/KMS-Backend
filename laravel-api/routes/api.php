<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Ensure your AuthController is imported

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// --- Public Authentication Routes ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// --- Authenticated Routes (Requires a Sanctum token) ---
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Optional: Logout method, accessible only when authenticated
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);