<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageCreateRequest;
use App\Http\Resources\MessageResource;
use App\Models\File;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create(MessageCreateRequest $request): JsonResponse|MessageResource
    {

        if (!$request->validated('body') && !$request->file('file')) {
            return response()->json([
                'success' => false,
                'message' => 'Пустые сообщения - не лучший способ общаться, отправьте хоть что-то =)',
                'code' => 400
            ], 400);
        }

        $message = new Message();
        if ($body = $request->validated('body')) {
            $fillData = [
                'body' => $body,
                'chat_id' => $request->validated('chat_id'),
                'user_id' => Auth::id()
            ];
        } else {
            $fillData = [
                'body' => '',
                'chat_id' => $request->validated('chat_id'),
                'user_id' => Auth::id()
            ];
        }

        $message->fill($fillData);
        $message->save();

        if ($uploadFile = $request->file('file')) {

            $message->files()->create([
                'path' => $uploadFile->store(File::FILES_DIRECTORY, 'public'),
                'name' => $uploadFile->getClientOriginalName(),
                'extension' => $uploadFile->getClientOriginalExtension()
            ]);
        }

        return new MessageResource($message);
    }

    public function delete(Message $message): JsonResponse
    {
        return response()->json([
            'success' => $message->delete()
        ]);
    }

}
