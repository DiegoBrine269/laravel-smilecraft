<?php

namespace App\Http\Requests;

use App\Rules\FechaEntregaValida;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;

class TrabajoRequest extends FormRequest
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
            'id_descripcion' => ['required', 'integer', 'exists:descripciones,id'],
            'id_doctor' => ['required', 'integer', 'exists:doctores,id'],
            'paciente' => ['required', 'string'],
            'id_tono' => ['string',  'exists:tonos,id'],
            'fecha_recepcion' => ['required', 'date'],
            'fecha_entrega' => [
                'nullable', // Puede ser nulo
                'date',    // Debe ser una fecha válida
                function ($attribute, $value, $fail) {
                    $fechaRecepcion = $this->input('fecha_recepcion');
    
                    if ($value && strtotime($value) < strtotime($fechaRecepcion)) {
                        $fail('La fecha de recepción debe ser anterior o igual a la fecha de entrega.');
                    }
                }
            ],
            'urgente' => ['required', 'boolean'] 
        ];
    }

    public function messages() : array {
        return [
            'id_descripcion.required' => 'La descripción es obligatoria',
            'id_descripcion.integer' => 'Por favor, escoge una descripción',
            'id_descripcion.exists' => 'Por favor, escoge una descripción',
            'id_doctor.required' => 'El nombre del doctor es obligatorio',
            'id_doctor.exists' => 'Por favor, escoge un tono',
            'paciente.required' => 'El nombre del paciente es obligatorio',
            'id_tono.exists' => 'Selecciona un tono',
            'fecha_recepcion.required' => 'La fecha de recepción es obligatoria',
            'fecha_recepcion.date' => 'Fecha de recepción incorrecta',

            'fecha_entrega.date' => 'Fecha de recepción incorrecta',
            // 'fecha_entrega.after_or_equal' => 'La fecha de entrega debe ser posterior a la fecha de recepción',
            'urgente.required' => 'Urgente es obligatorio',
            'urgente.boolean' => 'Urgente debe ser booleno',
            // 'fecha_recepcion.before_or_equal' => 'La fecha de recepción debe ser previa a la fecha de entrega'
        ];
    }
}
