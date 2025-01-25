<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as VueResponse;

class IndexController extends Controller
{
    public function index(): VueResponse
    {
        return Inertia::render('Welcome', [
           'users' => User::query()->get()
        ]);
    }
}
