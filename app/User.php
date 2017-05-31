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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function findOrCreateChat(User $user)
    {
        $chat = $this->findChat($user);
        if (!$chat) {
            $chat = Chat::create()->fresh();
            $chat->users()->syncWithoutDetaching($this, $user);
            $chat->users()->syncWithoutDetaching($user, $this);
        }
        return $chat;
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function findChat(User $user)
    {
        if ($user->id != $this->id) {
            return Chat::where('is_group', false)
                ->whereHas('users', function ($query) use ($user) {
                    $query->where('users.id', $this->id)
                        ->where('users.id', '!=', $user->id);
                })->whereHas('users', function ($query) use ($user) {
                    $query->where('users.id', $user->id)
                        ->where('users.id', '!=', $this->id);
                })->first();
        } else {
            $chat = Chat::where('is_group', false)
                ->whereHas('users', function ($query) {
                    $query->where('users.id', $this->id);
                })->with('users')->get();
            return $chat->reject(function ($item, $key) {
                if($item->users->count() > 1) {
                    return true;
                }
            })->first();
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outboxMessages()
    {
        return $this->hasMany(Message::class, 'from_user_id');
    }

}
