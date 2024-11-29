<?php

namespace App\Http\Controllers\API\V1;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;


class MainController extends ApiController
{

    public function index(Request $request)
    {
        //
    }

    public function init()
    {
        return [
            'user' => Auth::user() ?? null,
        ];
    }
}
