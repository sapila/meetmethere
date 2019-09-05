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
    Route::post('/users', 'User\Http\Controllers\RegistrationController@store');
    Route::post('/login', 'User\Http\Controllers\LoginController@login');
});


Route::middleware(['auth:api'])->group(function () {

    Route::get('/friend-requests', 'User\Http\Controllers\FriendRequestsController@index'); // TODO
    Route::post('/friend-requests', 'User\Http\Controllers\FriendRequestsController@store');
    Route::patch('/friend-invites/{friendRequestId}', 'User\Http\Controllers\FriendRequestsController@update');

    Route::get('/groups', 'Group\Http\Controllers\GroupController@index'); // TODO + search
    Route::get('/groups/{groupId}', 'Group\Http\Controllers\GroupController@show'); // TODO
    Route::post('/groups', 'Group\Http\Controllers\GroupController@store');

    Route::get('/groups/{groupId}/users', 'Group\Http\Controllers\GroupController@getGroupUsers');
    Route::post('/groups/{groupId}/users', 'Group\Http\Controllers\GroupController@rsvpUser');
});