<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'who' => ['required', 'int', 'exists:users,id'],
            'with' => ['required', 'int', 'exists:users,id']
        ];
    }
}
