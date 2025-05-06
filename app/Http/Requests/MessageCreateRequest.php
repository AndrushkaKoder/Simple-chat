<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'chat_id' => ['required', 'int', 'exists:chats,id'],
            'body' => ['nullable', 'string', 'min:1'],
            'file' => ['nullable']
        ];
    }
}
