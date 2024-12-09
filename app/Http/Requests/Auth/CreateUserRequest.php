<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CreateUserRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => 'nullable|string|min:1|max:30',
            'phone' => ['nullable', 'string', 'regex:/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'role' => ['nullable', Rule::in(['user', 'supplier'])],
            'password' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Пожалуйста, укажите ваше имя.',
            'email.required' => 'Пожалуйста, введите ваш адрес электронной почты.',
            'email.email' => 'Пожалуйста, укажите действительный адрес электронной почты.',
            'email.unique' => 'Пользователь с указанным адресом электронной почты уже существует. Пожалуйста, используйте другой адрес.',
            'type.required' => 'Пожалуйста, выберите тип.',
            'type.in' => 'Выбранный тип не допустим. Пожалуйста, выберите один из доступных вариантов.',
            'password.required' => 'Пожалуйста, введите пароль.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
