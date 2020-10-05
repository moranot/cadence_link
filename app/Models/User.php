<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Playlists\Playlist;
use App\Models\Model;
use App\Traits\Validator;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Validator;

    protected $fillable = [
        'username', 'email', 'password', 'group'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $rules = [
        'username' => 'required|max:255|string',
        'email' => 'required|email',
        'password' => 'required|regex:^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z].*).{8,}$'
    ];

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }
}
