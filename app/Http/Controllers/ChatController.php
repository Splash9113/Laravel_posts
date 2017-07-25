<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Services\ChatService;
use App\User;
use App\Chat;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->middleware('auth');
        $this->chatService = $chatService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'chats' => $this->chatService->getChats(),
            'users' => User::all()
        ];
        return view('chat.chats', $data);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privateChat(User $user)
    {
        $chat = (Auth::user())->findOrCreateChat($user);

        $data = [
            'chat' => $chat,
            'messages' => $chat->messages()->get()
        ];
        return view('chat.chat', $data);
    }

    /**
     * @param Chat $chat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chat(Chat $chat)
    {
        if (!policy($chat)->chatAllowed(Auth::user(), $chat)) {
            abort(403);
        }
        $data = [
            'chat' => $chat,
            'messages' => $chat->messages()->with('from')->get()
        ];
        return view('chat.chat', $data);
    }

    /**
     * @param StoreMessageRequest $request
     * @param Chat $chat
     */
    public function send(StoreMessageRequest $request, Chat $chat)
    {
        if (!policy($chat)->chatAllowed(Auth::user(), $chat)) {
            abort(403);
        }

        $this->chatService->storeMessage($request, $chat);
    }
}
