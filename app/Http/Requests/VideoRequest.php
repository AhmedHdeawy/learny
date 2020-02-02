<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use APP\Models\Language;

class VideoRequest extends FormRequest
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
            'category_id'  =>  'nullable|numeric',
            'videos_name'  =>  'required',
            'videos_status'  =>  'required',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $languag) {
            $rules[ $languag->locale. '.videos_title' ] = 'required|min:2';
            // $rules[ $languag->locale. '.videos_desc' ] = 'required';
        }

        if ($this->isMethod('PUT')) {
            $rules['videos_name'] = 'nullable';
        }

        return $rules;
    }
}
