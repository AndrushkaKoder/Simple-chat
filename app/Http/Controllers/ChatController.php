<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatCreateRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as VueResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ChatController extends Controller
{
    /**
     * @return VueResponse
     */
    public function index(): VueResponse
    {
        /*** @var Authenticatable|User $user */
        $user = Auth::user();

        return Inertia::render('Chat/Index', [
            'auth' => $user,
            'chats' => ChatResource::collection($user->chats),
        ]);
    }

    /**
     * @param Chat $chat
     * @return VueResponse
     */
    public function show(Chat $chat): VueResponse
    {
        /*** @var Authenticatable|User $user */
        $user = Auth::user();

        if (!$user->chats()->where('id', $chat->id)->count()) {
            return Inertia::render('Welcome');
        }
        return Inertia::render('Chat/Show', [
            'auth' => $user,
            'chats' => ChatResource::collection($user->chats),
            'currentChat' => new ChatResource($chat)
        ]);
    }

    /**
     * @param ChatCreateRequest $request
     * @return SymfonyResponse
     * Создание, либо возврат чата
     */
    public function create(ChatCreateRequest $request): SymfonyResponse
    {
        /*** @var Authenticatable|User $user */
        $user = Auth::user();

        $chat = $user->chats()->whereHas('users', function (Builder $query) use ($request) {
            $query->where('user_id', $request['with']);
        })->first();

        if (!$chat) {
            $chat = $user->chats()->create();
            $chat->users()->syncWithoutDetaching([$request['with'], Auth::id()]);
        }

        return redirect()->route('chat.show', $chat->id);
    }
}
