<?php

namespace App\Http\Controllers;

use App\Http\Resources\DoctorCollection;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new DoctorCollection(Doctor::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        
        $doctor->nombre = $request->nombre;
        $doctor->save();

        return [
            'message' => 'Doctor actualizado correctamente'
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return [
            'message' => 'Doctor eliminado correctamente'
        ];
    }
}
