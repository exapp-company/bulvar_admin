<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSeoModuleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'page' => ['required','string','max:255'],
            'meta_title' => ['required','string'],
            'meta_description' => ['required','string'],
            'is_show' => ['boolean','nullable'],
        ];
    }
}
