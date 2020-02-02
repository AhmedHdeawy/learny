<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the admin is authorized to make this request.
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
        $rules = [
            'username' => 'required|min:2',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ];

        if ($this->isMethod('PUT')) {
            $rules['email'] = 'required|email|unique:admins,email,'. $this->segment(4) .',id';
            $rules['password'] = 'confirmed';
        }

        return $rules;
    }
}
