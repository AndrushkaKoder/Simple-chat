<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response as VueResponse;

class IndexController extends Controller
{
    public function index(): VueResponse
    {
        return Inertia::render('Welcome', [
            'auth' => Auth::user(),
            'users' => User::query()
                ->where('id', '!=', Auth::id())
                ->get()
        ]);
    }
}
