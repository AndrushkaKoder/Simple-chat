<?php

declare(strict_types=1);

namespace App\Repository\Chat;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ChatRepository implements ChatRepositoryInterface
{
    public function all(): Collection
    {
        return Chat::all();
    }

    public function findById(int $id): ?Model
    {
        return Chat::query()->find($id);
    }

    public function findBySlug(string $slug): ?Chat
    {
        return Chat::query()->whereSlug($slug)->first();
    }
}
