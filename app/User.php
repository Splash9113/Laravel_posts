<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }

    public function findOrCreateChat(User $user)
    {
        $chat = Chat::where('is_group', false)->whereHas('users', function ($query) use ($user) {
            $query->where('users.id', $this->id)
                ->orWhere('users.id', $user->id);
        })->first();
        if (!$chat) {
            $chat = Chat::create()->fresh();
            $chat->users()->sync($this, $user);
        }
        return $chat;
    }

    public function outboxMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }

}
