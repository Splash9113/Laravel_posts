<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'body', 'active', 'user_id'];

    protected $dates = ['deleted_at'];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function scopeActive($query, $active = true)
    {
        $query->where('active', $active);
    }
}
