<?php

namespace App;

use App\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'content'];


    protected $casts = [
        'pending' => 'boolean'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
    	$this->attributes['title'] = $value;

    	$this->attributes['slug'] = Str::slug($value);

    }

    public function getUrlAttribute()
    {
        return route('posts.show',[$this->id , $this->slug]);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

