<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DescripcionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trabajos = [
            'Incrustación (metal cerámico)' => ['precio' => '350', 'tipo' => 2],
            'Corona total (metal cerámico)' => ['precio' => '450', 'tipo' => 2],
            'Corona metal porcelana' => ['precio' => '700', 'tipo' => 2],
            'Corona metal porcelana sobre implante' => ['precio' => '1200', 'tipo' => 2],
            'Incrustación Ceramage' => ['precio' => '650', 'tipo' => 1],
            'Carilla Ceramage' => ['precio' => '700', 'tipo' => 1],
            'Corona Ceramage' => ['precio' => '800', 'tipo' => 1],
            'Incrustación disilicato de litio' => ['precio' => '1100', 'tipo' => 1],
            'Corona disilicato de litio monolítica' => ['precio' => '1300', 'tipo' => 1],
            'Corona disilicato de litio estratificada' => ['precio' => '1500', 'tipo' => 1],
            'Incrustación y carilla zirconia' => ['precio' => '1100', 'tipo' => 1],
            'Corona zirconia monolítica' => ['precio' => '1300', 'tipo' => 1],
            'Corona zirconia estratificada' => ['precio' => '1500', 'tipo' => 1],
            'Prótesis removible unilateral' => ['precio' => '1300', 'tipo' => 1],
            'Prótesis removible bilateral' => ['precio' => '2500', 'tipo' => 1],
            'Juego de placas totales' => ['precio' => '3000', 'tipo' => 1],
            'Encerado diagnóstico' => ['precio' => '150', 'tipo' => 1],
            'Provisional acrílico termocurable' => ['precio' => '250', 'tipo' => 1],
            'Porta impresión individual' => ['precio' => '100', 'tipo' => 1],
            'Rebase' => ['precio' => '400', 'tipo' => 1],
            'Acrilizado de guardas' => ['precio' => '450', 'tipo' => 1],
            'Placa parcial provisional 1 a 3 dientes' => ['precio' => '600', 'tipo' => 3],
            'Placa parcial provisional 4 a 6 dientes' => ['precio' => '800', 'tipo' => 3],
            'Placa parcial provisional 7 dientes en adelante' => ['precio' => '1000', 'tipo' => 3],
            'Gancho de bola' => ['precio' => '50', 'tipo' => 4],
            'Gancho wipla' => ['precio' => '100', 'tipo' => 4],
            'Gancho vaciado' => ['precio' => '300', 'tipo' => 4],
            
        ];
    
        foreach ($trabajos as $descripcion => $datos) {
            DB::table('descripciones')->insert([
                'desc' => $descripcion,
                'precio' => $datos['precio'],
                'tipo' => $datos['tipo']
            ]);
        }
    }
}
