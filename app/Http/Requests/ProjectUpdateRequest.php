<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
            'name' => 'required|max:255|min:2|unique:projects,name,'.$this->project->id,
            'adress' => 'required|max:255|min:2',
            'ssh' => 'max:255',
            'admin_login' => 'max:255',
            'admin_password' => 'max:255'
        ];
    }
}
