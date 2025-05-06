<?php

declare(strict_types=1);

namespace App\Services\Notification;

use App\Models\User;

class SmsService implements NotificationInterface
{
    public function send(User $user): void
    {
        /**
         * TODO создать отправку уведомлений по смс
         */
    }
}
