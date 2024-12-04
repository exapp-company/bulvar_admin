<?php

namespace App\Http\Middleware;

use App\Enums\HttpStatus;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    use ApiResponse;

    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        if (!in_array($user->role, $roles)) {
            return $this->error('У вас нет доступа для выполнения этого действия', HttpStatus::forbidden);
        }

        return $next($request);
    }



}
