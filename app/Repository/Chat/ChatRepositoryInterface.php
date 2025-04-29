<?php

declare(strict_types=1);

namespace App\Repository\Chat;

use App\Models\Chat;
use App\Repository\RepositoryInterface;

interface ChatRepositoryInterface extends RepositoryInterface
{
    public function findBySlug(string $slug): ?Chat;
}
