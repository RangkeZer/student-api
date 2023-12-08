<?php

use App\Http\Controllers\API\studentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('student', [studentController::class, 'index']);
Route::post('student/store', [studentController::class, 'store']);
Route::get('student/show/{id}', [studentController::class, 'show']);
Route::post('student/update/{id}', [studentController::class, 'update']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
