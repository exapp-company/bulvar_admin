<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Models\User;
use App\Enums\UserRoles;
use App\Enums\HttpStatus;
use Illuminate\Http\Request;
use App\Filters\UserRoleFilter;
use Illuminate\Validation\Rule;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Resources\Collections\UserCollection;

class UserController extends ApiController
{

    public function __construct(
        protected UserRepository $userRepository,
    ) {}

    public function index(Request $request)
    {
        $role = $request->input('role');
        $usersQuery = User::query();

        UserRoleFilter::apply($usersQuery, $role);

        return new UserCollection($usersQuery->paginate(30));
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->userRepository->register($request->validated());

        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'name' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', Rule::in(UserRoles::values())],
        ]);

        return new UserResource($this->userRepository->update($user, $request->all()));
    }


    public function destroy(User $user)
    {
        if ($user->delete()) {
            return $this->success(__('Пользователь успешно удален.'));
        } else {
            return $this->error(__('Произошла ошибка при удалении объекта.'), HttpStatus::internalServerError);
        }
    }
}
