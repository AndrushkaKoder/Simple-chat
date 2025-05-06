<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

final class UserService
{
    public function getCurrentUser(): Authenticatable|User
    {
        return Auth::user();
    }

    public function getUsersWithoutCurrent(): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::query()
                ->where('id', '!=', Auth::id())
                ->get()
        );
    }
}
