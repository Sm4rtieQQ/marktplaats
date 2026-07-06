<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'notifications'])]
#[Hidden(['password', 'remember_token'])]


class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function biddings()
    {
        return $this->hasMany(Bidding::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function receiver()
    {
        return $this->hasMany(Chat::class, 'receiver_uid');
    }

    public function sender()
    {
        return $this->hasMany(Chat::class, 'sender_uid');
    }
}
