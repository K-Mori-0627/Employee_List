<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordRule;

class EmployeeRequest extends FormRequest
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
            'name_kana' => ['required', 'max:20'],
            'name_roma' => ['required', 'max:20'],
            'email' => ['required', 'email:strict,dns,spoof'],
            'login_id' => ['required', 'min:8', 'max:20'],
            'role' => ['required'],
            'department' => ['required'],
            'password' => ['required', 'min:8', 'max:15', new PasswordRule()],
            'password_update' => ['nullable', 'min:8', 'max:15', new PasswordRule()],
        ];
    }
}
