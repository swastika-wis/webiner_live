<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'email' => 'required|email', 
            'phone' => 'required|regex:/^[0-9]{10}$/', 
            'field' => 'required|string', 

        ];
    }

    public function messages():array{
        return[
            'field.required'=>'Product/Service field is required.'
        ];
    }
}
