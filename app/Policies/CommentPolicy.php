<?php

namespace App\Policies;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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


    public function destroy(User $user, Comment $comment, Post $post)
    {
        return $user->id == $post->user_id || $user->id == $comment->user_id;
    }
}
