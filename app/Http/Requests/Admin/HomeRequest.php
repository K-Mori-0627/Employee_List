<?php

namespace App\Http\Requests\Admin;

use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:20'],
            'login_id' => ['required', 'min:8', 'max:20'],
            'password' => ['nullable', 'min:8', 'max:15', new PasswordRule()],
        ];
    }
}
