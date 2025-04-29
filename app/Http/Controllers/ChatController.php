<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChatCreateRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Services\Chat\ChatService;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
use Inertia\Response as VueResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ChatController extends Controller
{
    public function __construct(
        private ChatService $chatService
    )
    {
    }

    public function index(): VueResponse
    {
        return Inertia::render('Welcome', [
            'auth' => $this->chatService->currentUser(),
            'chats' => $this->chatService->getUserChats(),
        ]);
    }

    public function show(string $slug): VueResponse
    {
        $user = $this->chatService->currentUser();

        if (!$user->chats()->where('slug', $slug)->count()) {
            return Inertia::render('Welcome');
        }

        return Inertia::render('Chat/Show', [
            'auth' => $user,
            'chats' => ChatResource::collection($this->chatService->getUserChats()),
            'currentChat' => new ChatResource($this->chatService->currentChat($slug))
        ]);
    }

    public function create(ChatCreateRequest $request): RedirectResponse
    {
        $user = $this->chatService->currentUser();
        $chat = $user->chats()->whereHas('users', function (Builder $query) use ($request) {
            $query->where('user_id', $request->with);
        })->first();

        if (!$chat) {
            $chat = $user->chats()->create();
            $chat->users()->syncWithoutDetaching([$request->with, $user->id]);
        }

        return redirect()->route('chat.show', $chat->slug);
    }

    public function readMessages(Chat $chat): JsonResponse
    {
        return response()->json([
            'success' => $this->chatService->readChatMessages($chat),
            'code' => 200
        ]);
    }
}
