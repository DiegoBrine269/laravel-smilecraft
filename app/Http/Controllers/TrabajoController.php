<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Descripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TrabajoRequest;
use App\Http\Resources\TrabajoCollection;
use App\Models\Pago;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TrabajoCollection(
            Trabajo::leftJoin('doctores', 'trabajos.id_doctor', '=', 'doctores.id')
            ->leftJoin('tonos', 'trabajos.id_tono', '=', 'tonos.id')
            ->leftJoin('descripciones', 'trabajos.id_descripcion', '=', 'descripciones.id')
            ->select('folio', 'trabajos.id as id', 'paciente', 'descripciones.descr as descr', 'descripciones.tipo as tipo',
                    'urgente', 'trabajos.id_tono as id_tono', 'doctores.nombre as doctor',
                    'doctores.id as id_doctor', 'descripciones.id as id_descripcion',
                    'ganchos_bola', 'ganchos_wipla', 'ganchos_vaciado',
                    DB::raw('DATE_FORMAT(fecha_recepcion, "%d/%m/%Y") as fecha_recepcion'),
                    DB::raw('DATE_FORMAT(fecha_entrega, "%d/%m/%Y") as fecha_entrega'), 'total')
            ->orderBy('trabajos.id', 'DESC')
            ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrabajoRequest $request)
    {
        $trabajo = new Trabajo();
        
        $total = Descripcion::where('id', $request->id_descripcion)->select('precio')->first();
        $total = $total->precio;
                
        // Suma de costo de ganchos
        $costoGancho = 0;
        if($request->ganchos_bola !== 0){
            $costoGancho = Descripcion::where('descr', 'Gancho de bola')->select('precio')->first()->precio;
            $total = $total + $costoGancho * $request->ganchos_bola;
        } 
        
        if($request->ganchos_wipla !== 0) {
            $costoGancho = Descripcion::where('descr', 'Gancho wipla')->select('precio')->first()->precio;
            $total = $total + $costoGancho * $request->ganchos_wipla;
        } 
        
        if($request->ganchos_vaciado !== 0) {
            $costoGancho = Descripcion::where('descr', 'Gancho vaciado')->select('precio')->first()->precio;
            $total = $total + $costoGancho * $request->ganchos_vaciado;
        }
        
        $total = $request->urgente ? $total * 1.3 : $total;
        
        $trabajo->id_descripcion = $request->id_descripcion;
        $trabajo->id_doctor = $request->id_doctor;
        $trabajo->paciente = $request->paciente;
        $trabajo->id_tono = $request->id_tono;
        $trabajo->folio = $request->folio;
        $trabajo->fecha_recepcion = $request->fecha_recepcion;
        $trabajo->fecha_entrega = $request->fecha_entrega;
        $trabajo->urgente = $request->urgente;
        $trabajo->total = $total;
        $trabajo->ganchos_bola = $request->ganchos_bola;
        $trabajo->ganchos_wipla = $request->ganchos_wipla;
        $trabajo->ganchos_vaciado = $request->ganchos_vaciado;
        $trabajo->save();
        
        // Registrando pago en caso de que exista
        if($request->a_cuenta) {
            $pago = new Pago();
            $pago->id_trabajo = $trabajo->id;
            $pago->monto = $request->a_cuenta;
            $pago->fecha = $trabajo->fecha_recepcion;
            $pago->save();
        }
        
        
        return [
            'message' => 'Trabajo guardado exitosamente'
        ];

    }

    /**
     * Display the specified resource.
     */
    public function show(Trabajo $trabajo)
    {
        return $trabajo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrabajoRequest $request, Trabajo $trabajo)
    {
        
        $total = Descripcion::where('id', $request->id_descripcion)->select('precio')->first();
        $total = $total->precio;
        
        // Suma de costo de ganchos
        $costoGancho = 0;
        if($request->ganchos_bola !== 0){
            $costoGancho = Descripcion::where('descr', 'Gancho de bola')->select('precio')->first()->precio;
            $total = $total + $costoGancho * $request->ganchos_bola;
        } 
        
        if($request->ganchos_wipla !== 0) {
            $costoGancho = Descripcion::where('descr', 'Gancho wipla')->select('precio')->first()->precio;
            $total = $total + $costoGancho * $request->ganchos_wipla;
        } 
        
        if($request->ganchos_vaciado !== 0) {
            $costoGancho = Descripcion::where('descr', 'Gancho vaciado')->select('precio')->first()->precio;
            $total = $total + $costoGancho * $request->ganchos_vaciado;
        }
        
        $total = $request->urgente ? $total * 1.3 : $total;
        
        // Actualización en general
        $trabajo->id_descripcion = $request->id_descripcion;
        $trabajo->id_doctor = $request->id_doctor;
        $trabajo->paciente = $request->paciente;
        $trabajo->id_tono = $request->id_tono;
        $trabajo->folio = $request->folio;
        $trabajo->fecha_recepcion = $request->fecha_recepcion;
        $trabajo->fecha_entrega = $request->fecha_entrega;
        $trabajo->urgente = $request->urgente;
        $trabajo->total = $total;
        $trabajo->ganchos_bola = $request->ganchos_bola;
        $trabajo->ganchos_wipla = $request->ganchos_wipla;
        $trabajo->ganchos_vaciado = $request->ganchos_vaciado;
        $trabajo->save();

        // Registrando pago en caso de que exista
        if($request->a_cuenta) {
            $pago = new Pago();
            $pago->id_trabajo = $trabajo->id;
            $pago->monto = $request->a_cuenta;
            $pago->fecha = $trabajo->fecha_recepcion;
            $pago->save();
        }


        return [
            'message' => 'Trabajo guardado exitosamente'
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trabajo $trabajo)
    {
        $trabajo->delete();

        return [
            'message' => 'Trabajo eliminado'
        ];
    }


    public function pagos(Trabajo $trabajo)
    {
        return $trabajo->pagos;
    }

    public function deudas($id_doctor)
    {
        $trabajos = Trabajo::where('id_doctor', $id_doctor)
                    ->select('trabajos.id as id', 'descripciones.id as id_descripcion',
                            'descr', 'paciente', 'id_tono', 'folio', DB::raw('DATE_FORMAT(fecha_recepcion, "%d/%m/%Y") as fecha'), 'precio as total')
                    ->join('descripciones', 'trabajos.id_descripcion', 'descripciones.id')
                    ->get();

        $trabajos->transform(function ($trabajo) {
            $a_cuenta = intval(Pago::where('id_trabajo', $trabajo->id)->sum('monto'));
        
            // Asignar el valor calculado a la instancia de Trabajo
            $trabajo->a_cuenta = $a_cuenta;
        
            return $trabajo;
        });
        
        $trabajosAdeudados = $trabajos->filter(function ($item) {
            return $item->a_cuenta < $item->total;
        })->values();
        
        return $trabajosAdeudados;
        
    }
}
