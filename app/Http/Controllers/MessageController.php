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
    public function create(MessageCreateRequest $request): MessageResource
    {
        $message = new Message();
        $message->fill($request->validated() + ['user_id' => Auth::id()]);
        $message->save();

        if ($uploadFile = $request->file('file')) {

            $message->files()->create([
                'path' => $uploadFile->store(File::FILES_DIRECTORY, 'public')
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
