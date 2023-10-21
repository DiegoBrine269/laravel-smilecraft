<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DescripcionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'descr' => ['required', 'string'],
            'precio' => ['required', 'integer'],
            'tipo' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'descr.required' => 'La descripción es obligatoria',
            'precio.required' => 'El precio es obligatorio',
            'tipo.required' => 'El tipo de trabajo es obligatorio'
        ];
    }
}
