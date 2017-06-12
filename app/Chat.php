<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'to_chat_id');
    }

    public function lastMessage()
    {
        return $this->messages()->orderBy('created_at', 'desc')->first();
    }

    public function getChatNameAttribute()
    {
        if ($this->name) {
            return $this->name;
        }
        $name = '';
        foreach ($this->users as $user) {
            if ($user->id != Auth::user()->id) {
                $name .= $user->name;
            }
        }
        return $name ? $name : $this->users[0]->name;
    }

}
