<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Department;

class CreateDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', new Department());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dTitle' => 'required|string|max:300|min:4|unique:departments,dTitle',
        ];
    }
}
