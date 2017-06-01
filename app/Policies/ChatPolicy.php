<?php

namespace App\Policies;

use App\Chat;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Chat $chat
     * @return bool
     */
    public function chatAllowed(User $user, Chat $chat)
    {
        return $chat->users()->get()->contains($user);
    }
}
