<?php

use Illuminate\Support\Facades\Route;

//posts
Route::apiResource('/employees', App\Http\Controllers\Api\EmployeeController::class);