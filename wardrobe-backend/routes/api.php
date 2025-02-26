<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClothingItemController;
use App\Http\Controllers\CategoryController;

// Public Routes (No Authentication Required)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Require Authentication via Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Clothing Items API (CRUD)
    Route::apiResource('clothing-items', ClothingItemController::class);

    // Categories API (List categories)
    Route::get('/categories', [CategoryController::class, 'index']);
});

// CSRF Protection for Sanctum Authentication
Route::prefix('sanctum')->group(function () {
    Route::get('/csrf-cookie', function (Request $request) {
        return response()->noContent();
    });
});

// Test Route (Optional: Check if API is working)
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
