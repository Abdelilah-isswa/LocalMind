<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
       protected $hidden = [
        'password',
        'remember_token',
    ];
    public function questions()
{
    return $this->hasMany(Question::class);
}

public function isAdmin(): bool
{
    return $this->role === 'admin';
}
public function favoriteQuestions()
{
    return $this->belongsToMany(Question::class, 'favorites')
                ->withTimestamps();
}

}
