<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'required',
                'min:1',
                'max:100',
            ],
            'description' => [
                'string',
                'nullable',
                'max:65535'
            ],
            'position' => [
                'integer',
                'required',
                'min:0',
                'max:10000'
            ],
            'project_id' => [
                'integer',
                'required',
                'min:0'
            ],
            'attached_file' => [
                'file',
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => $this->get('title') ?: "",
            'description' => $this->get('description') ?: "",
            'position' => $this->get('position') ?: 0,
        ]);
    }
}
