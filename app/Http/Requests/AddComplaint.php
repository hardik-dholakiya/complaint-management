<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddComplaint extends FormRequest
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
            'complaint_subject'=>'required|max:255',
            'complaint_text'=>'required|max:500',
        ];
    }
}
