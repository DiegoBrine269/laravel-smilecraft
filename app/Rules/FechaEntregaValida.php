<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FechaEntregaValida implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        $fechaEntrega = request('fecha_entrega');

        // Si la fecha de entrega no está presente, la validación pasa automáticamente
        if (!$fechaEntrega) {
            return true;
        }

        // Validar que la fecha de recepción sea anterior a la fecha de entrega
        return strtotime($value) <= strtotime($fechaEntrega);
    }

    public function message()
    {
        return 'La fecha de recepción debe ser anterior o igual a la fecha de entrega.';
    }
}
