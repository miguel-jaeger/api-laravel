<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController
;
/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::get('/students', [studentController::class,'index']);

Route::post('/students', [studentController::class,'create']);

Route::put('/students/{id}', [studentController::class,'update']);
Route::patch('/students/{id}', [studentController::class,'updatePartials']);
Route::delete('/students/{id}', [studentController::class,'delete']);
Route::get('/students/{id}',[studentController::class,'show']);
