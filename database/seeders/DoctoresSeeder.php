<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombres = [
            'Juan Pérez', 'Ana Gómez', 'Carlos Rodríguez',
            'Laura Martínez', 'Andrés López', 'María Sánchez',
            'Javier Fernández', 'Patricia Ramírez', 'Luis Díaz',
            'Claudia Vargas'
        ];

        foreach ($nombres as $nombre) {
            DB::table('doctores')->insert([
                'nombre' => $nombre,
            ]);
        }
    }
}
