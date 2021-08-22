<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('login',[UserController::class,'login']);
Route::post('add',[UserController::class,'add']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('data/{id?}',[UserController::class,'getData']);
    Route::put('update',[UserController::class,'update']);
    Route::get('search/{keyword}',[UserController::class,'search']);
    Route::delete('delete/{id}',[UserController::class,'delete']);
    Route::post('upload',[UserController::class,'upload']);
});


