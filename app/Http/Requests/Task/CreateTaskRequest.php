<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Task;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', new Task());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'taskNumber' => 'required|numeric|unique:tasks,tNumber',
            //'taskDepartment' => 'required|string|max:300|min:4',
            'taskMenu' => 'required|string|max:800|min:4',
            'taskMaterial' => 'required|string|max:800|min:4',
            'taskPage' => 'required|numeric|min:1|max:999',
            'taskDateMaterial' => 'required|string|date|after_or_equal:today',
            'taskInitiatorName' => 'required|string|min:4|max:200',
            'taskInitiatorAdditional' => 'array|max:2',
            'taskDescriptionField' => 'present',
            'taskMenuLink' => 'present',
            //'taskFileUpload'  => 'mimes:doc,docx,rtf,zip,rar,txt,pdf,xls,xslx,jpg,png|max:20480|file',
        ];
    }
}
