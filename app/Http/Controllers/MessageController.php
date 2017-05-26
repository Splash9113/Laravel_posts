<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Services\MessageService;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public $messageService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->messageService = new MessageService();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'chats' => $this->messageService->getChats(),
            'users' => User::all()
        ];
        return view('message.messages', $data);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chat(User $user)
    {
        return view('message.chat', ['user' => $user]);
    }

    /**
     * @param StoreMessageRequest $request
     * @param User $user
     */
    public function send(StoreMessageRequest $request, User $user)
    {
        $chat = (Auth::user())->findOrCreateChat($user);
        $message = new Message($request->all());
        $message->to()->associate($chat);
        $message->from()->associate(Auth::user());
        $message->save();

        dd($message);
    }
}
