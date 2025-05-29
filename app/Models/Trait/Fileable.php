<?php

declare(strict_types=1);

namespace App\Models\Trait;

use App\Models\File;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Fileable
{
    public const FILES_DIRECTORY = 'Uploads';
    public const IMAGE_EXTENSIONS = [
        'png',
        'svg',
        'jpg',
        'webp',
        'gif'
    ];

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function saveFile(): void
    {
        $fileableClass = static::class;
    }

    public function getFile(): ?array
    {
        return null;
    }
}
