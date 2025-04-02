<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stu_fname' => 'string|max:255',
            'stu_gra_id' => 'integer',
            'stu_username' => 'string|max:255',
            'stu_password' => 'string|max:255',
            'stu_gender' => 'string|max:255',
            'stu_dob' => 'date',
            'stu_ph_number' => 'integer',
            'stu_parent_number' => 'integer',
            'stu_profile' => 'string|max:255',
        ];
    }
}
