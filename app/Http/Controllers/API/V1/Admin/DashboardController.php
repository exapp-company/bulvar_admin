<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\ApiController;

use App\Models\User;

class DashboardController extends ApiController
{
    public function __construct()
    {
    }

    public function index()
    {
        $users = User::get();

        return [
            'users_count' => $users->count(),
        ];
    }
}
