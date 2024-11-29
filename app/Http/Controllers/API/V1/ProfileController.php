<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\HttpStatus;
use App\Http\Controllers\ApiController;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends ApiController
{
    public function __construct(
        protected UserRepository $userRepository,
    ) {}

    public function index(Request $request)
    {
        $user = $request->user();
        return new UserResource($user);
    }

    public function update(UpdateProfileRequest $request)
    {

        $user = $this->userRepository->update(User::find($request->user()->id), $request->all());
        return new UserResource($user);
    }

    public function changePassword(PasswordUpdateRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->get('old_password'), $user->password)) {
            return $this->error(__('Неверный старый пароль'), HttpStatus::notFound);
        }

        $this->userRepository->changePassword(User::find($user->id), $request->input('password'));
        return new UserResource($user);
    }
}
