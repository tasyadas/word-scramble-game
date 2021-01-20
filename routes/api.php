<?php

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

Route::middleware('pages:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\Auth')->group(function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController');
        Route::post('logout', 'LogoutController');
    });
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'word'], function () {
    Route::namespace('App\Http\Controllers\Word')->group(function () {
        Route::get('show-question', 'ShowQuestionController');
        Route::post('answer-question', 'AnswerQuestionController');
    });
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('history', \App\Http\Controllers\History\HistoryController::class);
    Route::get('user', \App\Http\Controllers\Auth\ShowUserController::class);
});
