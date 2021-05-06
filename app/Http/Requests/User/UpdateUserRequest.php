<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', new User());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validateEditUser = [
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'uName' => 'string|max:60|min:4',
            'uLogin' => 'string|max:30|min:4',
            'uGroup' => 'numeric|max:255',
            'uDepartment' => 'string|max:200',
            'uPosition' => 'string|max:400',
        ];

        if ($this->uPassword) {
            $validateEditUser += ['uPassword' => 'string|max:30|min:10'];
        }

        return $validateEditUser;
    }
}
