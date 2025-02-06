<?php

namespace App\Http\Resources;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /*** @var Message $this */

        return [
            'id' => $this->id,
            'body' => $this->body,
            'is_inner' => $this->user_id === Auth::id(),
            'is_read' => $this->is_read,
            'created_at' => (new Carbon($this->created_at))->diffForHumans(),
            'file' => $this->getFilePath()
        ];
    }
}
