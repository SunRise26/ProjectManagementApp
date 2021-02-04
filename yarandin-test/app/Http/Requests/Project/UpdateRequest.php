<?php

namespace App\Http\Requests\Project;

use App\Rules\NotEmptyString;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'string',
                'max:100',
            ],
            'description' => [
                'string',
                'nullable',
                'max:65535'
            ],
            'position' => [
                'integer',
                'min:0',
                'max:10000'
            ],
        ];
    }
}
