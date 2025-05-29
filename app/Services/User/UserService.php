<?php

declare(strict_types=1);

namespace App\Services\User;

use App\DTO\User\UserProfileUpdate;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function updateUserProfile(UserProfileUpdate $dto): void
    {
        if (!is_null($dto->getEmail())) {
            $this->getCurrentUser()->email_verified_at = null;
        }

        if ($avatar = $dto->getAvatar()) {

        }

        $this->getCurrentUser()->fill([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'phone' => $dto->getPhone(),
            'password' => $dto->getPassword(),
        ])->save();
    }
}
