<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Hash;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum', 'namespace' => 'Api'], function() {
    
    //User
    Route::post('/registration', 'UsersController@registration');
    Route::post('/login', 'UsersController@login');
    Route::get('/notifications/{id}', 'UsersController@notifications');
    Route::get('/alluser', 'UsersController@allUser');

    //Friendable
    Route::post('/add-friend/{senderId}/{recipientId}', 'FriendableController@sendFriendRequest');
    Route::post('/confirmation/{recipientId}/{senderId}', 'FriendableController@confirmation');
    Route::post('/deny-friend-request/{recipientId}/{senderId}', 'FriendableController@denyFriendRequest');
    Route::get('/delete-friend/{userId}/{friendId}', 'FriendableController@deleteFriend');
});

