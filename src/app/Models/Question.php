<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'content',
        'location',
        'date',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}
public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites')
                ->withTimestamps();
}
}
