<?php

declare(strict_types=1);

namespace App\Services\Notification;

use App\Mail\UserRegisterEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailService implements NotificationInterface
{
    public function send(User $user): void
    {
        Mail::to(config('mail.app_email'))->send(new UserRegisterEmail($user));
    }
}
