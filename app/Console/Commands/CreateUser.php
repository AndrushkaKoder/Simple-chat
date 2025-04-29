<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'create:user',
    description: 'Make user'
)]
class CreateUser extends Command
{
    public function handle(): void
    {
        if (!app()->isProduction()) {
            User::query()->create([
                'name' => 'Andrushka',
                'email' => 'example@gmail.com',
                'password' => 123456789
            ]);
            $this->info('Success');
        } else {
            $this->error('Is prod');
        }
    }
}
