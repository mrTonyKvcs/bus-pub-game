<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class FriendableController extends Controller
{
    public function sendFriendRequest($senderId, $recipientId)
    {
        $user = User::find($senderId);
        $recipient = User::find($recipientId);
        $user->befriend($recipient);

        return response('Sikeres ismeros jeloles!', 201);
    }

    public function confirmation($recipientId, $senderId)
    {
        $user = User::find($recipientId);
        $sender = User::find($senderId);
        $user->acceptFriendRequest($sender);

        return response('Sikeresen elfogadtad a felkerest!', 201);
    }

    public function denyFriendRequest($recipientId, $senderId)
    {
        $user = User::find($recipientId);
        $sender = User::find($senderId);
        $user->denyFriendRequest($sender);

        return response('Sikeresen elutasitotad a felkerest!', 201);
    }

    public function deleteFriend($userId, $friendId)
    {
        $user = User::find($userId);
        $friend = User::find($friendId);
        $user->unfriend($friend);

        return response('Sikeresen torolted az ismerosodet!', 201);
    }
}
