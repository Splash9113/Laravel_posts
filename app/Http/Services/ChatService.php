<?php

namespace App\Http\Services;


use App\Chat;
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
}