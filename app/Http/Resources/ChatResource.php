<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ChatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /*** @var Chat $this */

        return [
            'id' => $this->id,
            'chatUser' => $this->users()->whereHas(
                'chats',
                function (Builder $query) {
                    $query->where('user_id', '!=', Auth::id());
                }
            )->firstOrFail(),
            'is_active' => $this->is_active,
            'is_private' => $this->is_private,
            'slug' => $this->slug,
            'messages' => MessageResource::collection($this->messages)
        ];
    }
}
