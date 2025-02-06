<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'chat_id',
        'body',
        'is_read'
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'message_id');
    }

    public function getFilePath(): ?string
    {
        if ($file = $this->files()->first()) {
            return $file->publicPath(true);
        }
        return null;
    }

    public function read(): bool
    {
        $this->is_read = true;
        $this->save();

        return true;
    }
}
