<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    protected $fillable = [
        'name',
        'is_active',
        'is_private'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'chat_user',
            'chat_id',
            'user_id'
        );
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'chat_id');
    }
}
