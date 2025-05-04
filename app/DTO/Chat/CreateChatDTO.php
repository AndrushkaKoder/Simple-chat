<?php

declare(strict_types=1);

namespace App\DTO\Chat;

final readonly class CreateChatDTO
{
    public function __construct(
        private int $whoCreated,
        private int $withCreated
    )
    {
    }

    public function getWhoCreated(): int
    {
        return $this->whoCreated;
    }

    public function getWithCreated(): int
    {
        return $this->withCreated;
    }
}
