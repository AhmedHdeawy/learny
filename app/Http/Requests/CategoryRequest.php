<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use APP\Models\Language;

class CategoryRequest extends FormRequest
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
            'categories_status'  =>  'required',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $languag) {
            $rules[ $languag->locale. '.categories_title' ] = 'required|min:2';
            $rules[ $languag->locale. '.categories_desc' ] = 'nullable';
        }

        return $rules;
    }
}
