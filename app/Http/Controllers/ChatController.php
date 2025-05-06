<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\Chat\CreateChatDTO;
use App\Http\Requests\ChatCreateRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Services\Chat\ChatService;
use App\Services\User\UserService;
use Inertia\Inertia;
use Inertia\Response as VueResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ChatController extends Controller
{
    public function __construct(
        private readonly ChatService $chatService,
        private readonly UserService $userService
    )
    {
    }


    public function index(): VueResponse
    {
        return Inertia::render('Welcome', [
            'auth' => $this->userService->getCurrentUser(),
            'chats' => $this->chatService->getUserChats(),
        ]);
    }


    public function show(string $slug): VueResponse
    {
        $user = $this->userService->getCurrentUser();

        if (!$user->hasChats($slug)) {
            return Inertia::render('Welcome');
        }

        return Inertia::render('Chat/Show', [
            'auth' => $user,
            'chats' => $this->chatService->getUserChats(),
            'currentChat' => new ChatResource($this->chatService->currentChat($slug))
        ]);
    }


    public function create(ChatCreateRequest $request): RedirectResponse
    {
        $chatSlug = $this->chatService
            ->createNewChat(
                new CreateChatDTO(
                    $request->validated('who'),
                    $request->validated('with')
                )
            );

        return redirect()->route('chat.show', $chatSlug);
    }


    public function readMessages(Chat $chat): JsonResponse
    {
        return response()->json([
            'success' => $this->chatService->readChatMessages($chat),
            'code' => 200
        ]);
    }

}
