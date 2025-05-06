<?php

declare(strict_types=1);

namespace App\Services\Notification;

use App\Models\User;

interface NotificationInterface
{
    public function send(User $user): void;
}
