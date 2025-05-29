<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\User\UserProfileUpdate;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function edit(): Response
    {
        return Inertia::render('Profile/Edit', [
            'user' => $this->userService->getCurrentUser()
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->userService->updateUserProfile(new UserProfileUpdate(...$request->validated()));
        return Redirect::route('profile.edit');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
