<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class File extends Model
{
    protected $fillable = [
        'message_id',
        'path',
        'name',
        'extension'
    ];

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'message_id');
    }

    public function publicPath(bool $withPort = false): string
    {
        return $withPort
            ?
            env('APP_URL') . ':' . env('APP_PORT') . '/storage/' . $this->path
            :
            env('APP_URL') . '/storage/' . $this->path;

    }
}
