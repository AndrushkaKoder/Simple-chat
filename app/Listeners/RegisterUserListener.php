<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\RegisterUser;
use App\Services\Notification\NotificationFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: RegisterUser::class)]
class RegisterUserListener implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(RegisterUser $event): void
    {
        NotificationFactory::getNotificationService()->send($event->user);
    }
}
