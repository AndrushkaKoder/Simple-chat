<?php

declare(strict_types=1);

namespace App\Services\Chat;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use App\Repository\Chat\ChatRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

final class ChatService
{
    public function __construct(
        private ChatRepositoryInterface $repository
    )
    {
    }

    public function currentUser(): Authenticatable|User
    {
        return Auth::user();
    }

    public function getUserChats(): Collection
    {
        return $this->currentUser()->chats;
    }

    public function currentChat(string $chatSlug): Chat
    {
        return $this->repository->findBySlug($chatSlug);
    }

    public function readChatMessages(Chat $chat): bool
    {
        $chat->messages->where('is_read', false)
            ->each(fn(Message $message) => $message->read());

        return true;
    }

}
