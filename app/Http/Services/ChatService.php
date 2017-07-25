<?php

namespace App\Http\Services;


use App\Events\ChatMessageWasReceived;
use App\Message;
use Illuminate\Support\Facades\Auth;

class ChatService
{

    public function getChats()
    {
        $chats = Auth::user()->chats()->with('users')->get();

        return $chats->map(function ($item, $key) {
            $item['lastMsg'] = $item->lastMessage();
            $item['chatName'] = $item->chatName;
            return $item;
        })->reject(function($item, $key) {
            if (!$item->lastMsg) {
                return true;
            }
        })->unique();
    }

    public function storeMessage($request, $chat) {
        $message = new Message($request->all());
        $message->to()->associate($chat);
        $message->from()->associate(Auth::user());
        $message->save();

        foreach($chat->users as $user) {
            broadcast(new ChatMessageWasReceived($message, $user));
        }
    }
}