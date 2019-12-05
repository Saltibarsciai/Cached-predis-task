<?php

namespace App\Http\Requests;

use App\Exceptions\FailedTaskRequest;
use App\Exceptions\FailedTaskRequestException;
use HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'name' => 'required|min:3'
        ];
    }
    protected function failedValidation(Validator $validator) {
        throw new FailedTaskRequestException();
    }
}
