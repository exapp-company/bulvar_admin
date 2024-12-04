<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateObjectRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2'],
            'status' => ['required', 'string', 'max:255', Rule::in(["доступен", "продан"])],
            'description' => ['required', 'string'],
            'is_show' => ['nullable', 'boolean'],
            'project_id' => ['required', 'integer', 'exists:projects,id'],
            'price' => ['required', 'numeric', 'min:1'],
        ];
    }
}
