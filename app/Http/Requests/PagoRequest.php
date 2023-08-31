<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoRequest extends FormRequest
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
            'id_trabajo' => ['integer', 'required'],
            'monto' => ['integer', 'required'],
            'fecha' => ['date', 'required']
        ];
    }

    public function messages()
    {
        return [
            'id_trabajo.integer' => 'El ID del trabajo debe ser entero',
            'monto.integer' => 'El monto debe ser un valor entero',
            'fecha.date' => 'La fecha no cumple con un formato válido',        
        ];
    }
}
