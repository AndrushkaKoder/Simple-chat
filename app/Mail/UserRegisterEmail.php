<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User|Authenticatable $user)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Новый пользователь зарегистрирован",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.register',
            with: [
                'username' => $this->user->name,
                'email' => $this->user->email,
                'created_at' => $this->user->created_at
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
