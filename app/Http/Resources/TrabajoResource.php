<?php

namespace App\Http\Resources;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Array_;
use Illuminate\Http\Resources\Json\JsonResource;

class TrabajoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $a_cuenta = intval(Pago::where('id_trabajo', $this->id)->sum('monto'));
        $pagos = Pago::where('id_trabajo', $this->id)
                ->select(DB::raw('DATE_FORMAT(fecha, "%d/%m/%Y") as fecha'), 'monto')
                ->get();
        $pagosArray = [];
        
        // No se debe retornar como array de objetos por la tabla de React
        foreach ($pagos as $pago) {
            array_push($pagosArray, [$pago->fecha, $pago->monto]);
        }

        return [
            'id' => $this->id,
            'folio' => $this->folio,
            'id_doctor' => $this->id_doctor,
            'id_descripcion' => $this->id_descripcion,
            'tipo' => $this->tipo,
            'paciente' => $this->paciente,
            'doctor' => $this->doctor,
            'trabajo' => $this->descr,
            'tono' => $this->id_tono,
            'extras' => $this->extras,
            'urgente' => $this->urgente ? 'Sí' : 'No',
            'fecha_recepcion' => $this->fecha_recepcion,
            'fecha_entrega' => $this->fecha_entrega,
            'a_cuenta' => $a_cuenta,
            'total' => $this->total,
            'pagos' => $pagosArray,
            'ganchos_bola' => $this->ganchos_bola,
            'ganchos_wipla' => $this->ganchos_wipla,
            'ganchos_vaciado' => $this->ganchos_vaciado,
        ];
    
        // return parent::toArray($request);
    }
}
