<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'profile_picture' => 'required|mimes:png,jpg,jpeg|max:5048',
            'username' => 'required',
            'phone_number' => 'required',
        ];
    }
}
