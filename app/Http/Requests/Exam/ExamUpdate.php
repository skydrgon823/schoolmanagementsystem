<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;

class ExamUpdate extends FormRequest
{

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
            'type' => 'required|string',
            'name' => 'required|string',
            'term' => 'required|numeric',
            'year' => 'required|numeric',
        ];
    }

}
