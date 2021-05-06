<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Group;

class UpdateGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', new Group());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gName' => 'string|max:60|min:4'
        ];
    }
}
