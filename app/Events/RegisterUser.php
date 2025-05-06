<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Authenticatable|User $user)
    {
    }
}
