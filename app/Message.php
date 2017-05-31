<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['body', 'reed', 'from_user_id', 'to_user_id'];

    public function from()
    {
        return $this->belongsTo('App\User', 'from_user_id', 'id');
    }

    public function to()
    {
        return $this->belongsTo(Chat::class, 'to_chat_id', 'id');
    }

}
