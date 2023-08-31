<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trabajo extends Model
{
    use HasFactory;
    public $timestamps = false;

    // protected $casts = [
    //     'fecha_rececpcion' => 'datetime:d/m/Y',
    //     'fecha_entrega' => 'datetime:d/m/Y', 
    // ];

    public function pagos() : HasMany
    {
        return $this->hasMany(Pago::class, 'id_trabajo', 'id');
    }
}
