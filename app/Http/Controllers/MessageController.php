<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Services\ChatService;
use App\User;
use App\Chat;
use App\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public $chatService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->chatService = new ChatService();
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
            'chat' => $this->chatService->getChat($chat),
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
            'chat' => $this->chatService->getChat($chat),
            'messages' => $chat->messages()->with('from')->get()
        ];
        return view('chat.chat', $data);
    }

    /**
     * @param StoreMessageRequest $request
     * @param Chat $chat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function send(StoreMessageRequest $request, Chat $chat)
    {
        if (!policy($chat)->chatAllowed(Auth::user(), $chat)) {
            abort(403);
        }
        $message = new Message($request->all());
        $message->to()->associate($chat);
        $message->from()->associate(Auth::user());
        $message->save();

        $data = [
            'chat' => $this->chatService->getChat($chat),
            'messages' => $chat->messages()->get()
        ];
        return view('chat.chat', $data);
    }
}
