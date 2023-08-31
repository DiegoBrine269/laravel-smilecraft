<?php

namespace App\Http\Controllers;

use App\Http\Requests\DescripcionRequest;
use App\Http\Resources\DescripcionCollection;
use App\Models\Descripcion;
use Illuminate\Http\Request;

class DescripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return(new DescripcionCollection(Descripcion::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DescripcionRequest $request)
    {

        $descripcion = new Descripcion();
        $descripcion->desc = $request->desc;
        $descripcion->precio = $request->precio;
        $descripcion->tipo = $request->tipo;

        $descripcion->save();

        return [
            'message' => 'Descripcion guardada exitosamente'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Descripcion $descripcion)
    {
        return $descripcion;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Descripcion $descripcion)
    {   
        $descripcion->precio = $request->precio;
        $descripcion->save();

        return [
            'message' => 'Descripción actualizada exitosamente'
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Descripcion $descripcion)
    {
        $descripcion->delete();

        return [
            'message' => 'Desripción eliminada correctamente'
        ];
    }
}
