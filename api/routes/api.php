<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::get('/students', function () {
    return "List off students";
});

Route::post('/students', function () {
    return "Create a new student";
});
Route::put('/students/{id}', function () {
    return "Update student";
});
Route::delete('/students/{id}', function () {
    return "Delete student";
});

