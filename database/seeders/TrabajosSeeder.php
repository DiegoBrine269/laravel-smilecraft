<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TrabajosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            ['4', '3', 'Pedro Carmona', 'B2', '211', '2023-08-04', '2023-08-05', '0', '2000'],
            ['6', '5', 'Mateo Herrera', '310-3A', '244', '2023-08-04', '2023-08-05', '0', '1800'],
            ['21', '2', 'Leonardo Aguilar', '410-4A', '3', '2023-08-04', '2023-08-05', '1', '3500'],
            ['12', '10', 'Valentina Medina', 'B4', '677', '2023-08-04', '2023-08-05', '0', '2500'],
            ['13', '10', 'Camila Jiménez', 'B3', '994', '2023-08-04', '2023-08-05', '1', '1500'],
            ['4', '10', 'Natalia Fernández', 'C2', '35', '2023-08-04', '2023-08-05', '0', '500'],
            ['2', '9', 'Manuel García', 'D4', '42', '2023-08-04', '2023-08-05', '0', '600'],
            ['7', '9', 'Isabella Gómez', 'B2', '137', '2023-08-04', '2023-08-05', '0', '700'],
        ];

        foreach ($datos as $dato) {
            DB::table('trabajos')->insert([
                'id_descripcion' => $dato[0],
                'id_doctor' => $dato[1],
                'paciente' => $dato[2],
                'id_tono' => $dato[3],
                'folio' => $dato[4],
                'fecha_recepcion' => $dato[5],
                'fecha_entrega' => $dato[6],
                'urgente' => $dato[7],
                'total' => $dato[8],
            ]);
        }
    }
}
