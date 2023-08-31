<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Trabajo;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    
    public function index() {

        // Estadísticas actuales
        $mesActual = date('m');
        $anioActual = date('Y');

        $ventasMesActual = Trabajo::whereRaw('MONTH(fecha_recepcion) = ?', [$mesActual])
                            ->whereRaw('YEAR(fecha_recepcion) = ?', [$anioActual])
                            ->sum('total');

        $ventasAnioActual = Trabajo::whereRaw('YEAR(fecha_recepcion) = ?', [$anioActual])
                            ->sum('total');

        $ventasTotales = Trabajo::sum('total');


        // Porcentaje de ventas para los doctores
        $idsDoctores = Doctor::all();
        $porcentajeVentaDoctores = [];       
        
        foreach ($idsDoctores as $d) {
            $id = $d->id;
            $nombre = $d->nombre;

            $ventaDoctor = Trabajo::where('id_doctor', $id)
                            // ->where(DB::raw('MONTH(fecha_recepcion)'), 9)
                            ->select(DB::raw('SUM(total) as total'))
                            ->get()[0]->total;
            
            $porcentajeDoctor = [
                'doctor' => $nombre,
                'porcentaje' => $ventaDoctor * 100 / $ventasTotales
            ];
            array_push($porcentajeVentaDoctores, $porcentajeDoctor);
        }
        


        return [
            'ventasTotales' => $ventasTotales,
            'ventasMesActual' => $ventasMesActual,
            'ventasAnioActual' => $ventasAnioActual,
            'porcentajes' => $porcentajeVentaDoctores
        ];
    }

    public function anual (string $anio) {
        $ventasTotales = Trabajo::whereRaw('YEAR(fecha_recepcion) = ?', [$anio])
                            ->sum('total');

        if(!$ventasTotales)
            return null;

        $idsDoctores = Doctor::all();
        $porcentajeVentaDoctores = [];      

        foreach ($idsDoctores as $d) {
            $id = $d->id;
            $nombre = $d->nombre;

            $ventaDoctor = Trabajo::where('id_doctor', $id)
                            ->where(DB::raw('YEAR(fecha_recepcion)'), $anio)
                            ->select(DB::raw('SUM(total) as total'))
                            ->get()[0]->total;
            
            $porcentajeDoctor = [
                'doctor' => $nombre,
                'porcentaje' => $ventaDoctor * 100 / $ventasTotales
            ];
            array_push($porcentajeVentaDoctores, $porcentajeDoctor);
        }
        
        return [
            'ventasTotales' => $ventasTotales,
            'porcentajes' => $porcentajeVentaDoctores
        ];
    }
}