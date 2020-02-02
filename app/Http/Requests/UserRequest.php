<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'phone' => 'required|min:2|max:30|unique:users,phone',
            'status' => 'required',
        ];

        if ($this->isMethod('PUT')) {
            $rules['phone'] = 'required|unique:users,phone,'. $this->segment(4) .',id';
        }

        return $rules;
    }
}
