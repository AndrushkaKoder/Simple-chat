<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageCreateRequest;
use App\Http\Requests\MessageDeleteRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create(MessageCreateRequest $request): MessageResource
    {
        $message = new Message();
        $message->fill($request->validated() + ['user_id' => Auth::id()]);
        $message->save();

        return new MessageResource($message);
    }

    public function delete(Message $message): JsonResponse
    {
        return response()->json([
            'success' => $message->delete()
        ]);
    }

}
