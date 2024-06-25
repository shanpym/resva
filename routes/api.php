<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Tasks;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function (){
//     Route::get('/tasks', [Tasks::class, 'index']);
// });
Route::apiResource('/tasks', Tasks::class);