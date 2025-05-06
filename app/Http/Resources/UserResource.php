<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /**
         * @var Authenticatable|User $this
         */

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d')
        ];
    }
}
