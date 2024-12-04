<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateProjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['required','string','min:2'],
            'status' => ['required','string','max:255',Rule::in(["в разработке", "завершен"])],
            'description' => ['required','string'],
            'is_show' => 'nullable|boolean',
        ];
    }
}
