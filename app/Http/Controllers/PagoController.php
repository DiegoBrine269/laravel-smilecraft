<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagoRequest;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PagoCollection;


class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PagoCollection(
            Pago::join('trabajos', 'pagos.id_trabajo', '=', 'trabajos.id')
            ->join('doctores', 'trabajos.id_doctor', '=', 'doctores.id')
            ->join('descripciones', 'trabajos.id_descripcion', '=', 'descripciones.id')
            ->select('pagos.id as id', 'id_trabajo', 'monto', DB::raw('DATE_FORMAT(fecha, "%d/%m/%Y") as fecha'), 
                    'doctores.nombre as doctor', 'desc as trabajo', 'folio')
            ->orderBy('pagos.id', 'DESC')
            ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PagoRequest $request)
    {
        $pago = new Pago();
        $pago->id_trabajo = $request->id_trabajo;
        $pago->monto = $request->monto;
        $pago->fecha = $request->fecha;
        $pago->save();

        return [
            'message' => 'Pago registrado'    
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        $pago->delete();

        return [
            'message' => 'Pago eliminado correctamente'
        ];
    }
}
