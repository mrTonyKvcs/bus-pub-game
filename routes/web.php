<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//User
Route::get('notifications', [ 'as' => 'users.notifications', 'uses' => 'UsersController@notifications']);

//Friendable
Route::get('add-friend/{recipientId}', [ 'as' => 'friendable.add-friend', 'uses' => 'FriendableController@sendFriendRequest' ]);
Route::get('delete-friend/{recipientId}', [ 'as' => 'friendable.delete-friend', 'uses' => 'FriendableController@deleteFriend' ]);
Route::get('deny-friend-request/{senderId}', [ 'as' => 'friendable.deny-friend-request', 'uses' => 'FriendableController@denyFriendRequest' ]);

Route::get('confirmation/{senderId}', [ 'as' => 'friendable.confirmation', 'uses' => 'FriendableController@confirmation' ]);

