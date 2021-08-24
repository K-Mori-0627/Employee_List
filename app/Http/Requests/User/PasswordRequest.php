<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordRule;
use App\Rules\CurrentPasswordRule;

class PasswordRequest extends FormRequest
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
            'current' => ['required', 'min:8', 'max:15', new PasswordRule(), new CurrentPasswordRule()],
            'password' => ['required', 'min:8', 'max:15', 'confirmed', new PasswordRule()],
        ];
    }
}
