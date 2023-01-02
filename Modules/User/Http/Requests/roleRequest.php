<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class roleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:roles,name',
        ];
    }
    public function messages()
    {
        return [
            'name.unique'  => 'Role is already taken',
        ];
    }
}
