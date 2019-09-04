<?php

use Illuminate\Http\Request;
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

Route::middleware(['guest'])->group(function () {
    Route::post('/users', 'User\Http\Controllers\RegistrationController@register');
    Route::post('/login', 'User\Http\Controllers\LoginController@login');
});


Route::middleware(['auth:api'])->group(function () {
    Route::post('/friend-requests', 'User\Http\Controllers\FriendRequestsController@create');
    Route::patch('/friend-invites/{friendRequestId}', 'User\Http\Controllers\FriendRequestsController@patch');
});