<?php

declare(strict_types=1);

namespace App\Services\Notification;

final class NotificationFactory
{
    public static function getNotificationService(string $type = 'email'): NotificationInterface
    {
        return match ($type) {
            'email' => new EmailService(),
            'sms' => new SmsService()
        };
    }
}
