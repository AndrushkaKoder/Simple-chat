<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Inertia\Inertia;
use Inertia\Response as VueResponse;

class IndexController extends Controller
{
    public function index(UserService $service): VueResponse
    {
        return Inertia::render('Welcome', [
            'auth' => $service->getCurrentUser(),
            'users' => $service->getUsersWithoutCurrent()
        ]);
    }
}
