<?php

declare(strict_types=1);

namespace App\Services\Chat;

use App\DTO\Chat\CreateChat;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\Message;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ChatService
{
    public function __construct(private UserService $userService)
    {
    }

    public function getUserChats(): AnonymousResourceCollection
    {
        return ChatResource::collection($this->userService->getCurrentUser()->chats);
    }

    public function currentChat(string $chatSlug): Chat
    {
        return Chat::query()->whereSlug($chatSlug)->firstOrFail();
    }

    public function createNewChat(CreateChat $dto): string
    {
        $user = $this->userService->getCurrentUser();
        $chat = $user->chats()->whereHas('users', function (Builder $query) use ($dto) {
            $query->where('user_id', $dto->getWithCreated());
        })->first();

        if (!$chat) {
            $chat = $user->chats()->create();
            $chat->users()->syncWithoutDetaching([$dto->getWithCreated(), $dto->getWhoCreated()]);
        }

        return $chat->slug;
    }

    public function readChatMessages(Chat $chat): bool
    {
        $chat->messages->where('is_read', false)->each(fn(Message $message) => $message->read());

        return true;
    }
}
