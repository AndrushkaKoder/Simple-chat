<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setEmailAttribute(string $email): void
    {
        $this->attributes['email'] = mb_strtolower($email);
    }

    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(
            Chat::class,
            'chat_user',
            'user_id',
            'chat_id'
        );
    }

    public function hasChats(string $slug = null): bool
    {
        return !$slug ? $this->chats->count() > 0 : $this->chats->where('slug', $slug)->count() > 0;
    }
}
