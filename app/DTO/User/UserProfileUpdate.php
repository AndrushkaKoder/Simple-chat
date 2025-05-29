<?php

declare(strict_types=1);

namespace App\DTO\User;

use Illuminate\Http\UploadedFile;

final readonly class UserProfileUpdate
{
    public function __construct(
        private ?string $name,
        private ?string $email,
        private ?string $phone,
        private ?string $password,
        private ?UploadedFile $avatar
    ) {
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAvatar(): ?UploadedFile
    {
        return $this->avatar;
    }
}
