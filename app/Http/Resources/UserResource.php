<?php

namespace App\Http\Resources;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'role_readable' => UserRoles::readable($this->role),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
        ];
    }
}
