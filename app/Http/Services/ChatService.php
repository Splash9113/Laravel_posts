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

    public function getChat(Chat $chat)
    {
        $chat['chatName'] = $this->selectChatName($chat);
        return $chat;
    }

    /**
     * @param $chat
     * @return mixed
     */
    private function selectChatName($chat)
    {
        if ($chat->name) {
            return $chat->name;
        }
        foreach ($chat->users as $user) {
            if ($user->id != Auth::user()->id) {
                return $user->name;
            }
        }
        return $chat->users[0]->name;
    }
}