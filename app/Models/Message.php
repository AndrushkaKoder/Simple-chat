<?php

declare(strict_types=1);

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

    public function getFile(): ?array
    {
        if ($file = $this->files()->first()) {
            return [
                'src' => $file->publicPath(true),
                'name' => $file->name,
                'extension' => $file->extension,
                'is_image' => in_array($file->extension, File::IMAGE_EXTENSIONS)
            ];
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
