<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Events\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{

    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::query()->create($request->validated());
        Auth::login($user);
        event(new RegisterUser($user));

        return redirect(route('chat.index'));
    }
}
