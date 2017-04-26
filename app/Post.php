<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','body', 'active', 'user_id'];

    public function scopeActive($query, $active = true) {
        $query->where('active', $active);
    }
}