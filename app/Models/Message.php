<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Trait\Fileable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use Fileable;

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

    public function read(): bool
    {
        $this->is_read = true;
        $this->save();

        return true;
    }
}
