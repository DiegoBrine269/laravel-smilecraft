<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TonosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            'Chromascop' => [ '110-01', '120-1A', '130-2A', '140-1C', '210-2B',
                              '220-1D', '230-1E', '240-2C', '310-3A', '320-5B',
                              '330-2E', '340-3E', '410-4A', '420-6B', '430-4B',
                              '440-6C', '510-6D', '520-4C', '350-3C', '540-4D',
                        ],

            'Vita máster' => ['1M-1', '1M-2', '2L-1.5', '2L-2.5', '2M-1',
                              '2M-2', '2M-3', '2R-1.5', '2R-2.5', '3L-1.5', 
                              '3L-2.5', '3M-1', '3M-3', '3R-1.5', '3R-2.5',
                              '4L-1.5', '4L-2.5', '4M-1', '4M-2', '4M-3',
                               '4R-1.5', '4R-2.5', '5M-1', '5M-2', '5M-3'
                            ],

            'Vita classical' => [ 'A1', 'A2', 'A3', 'A3.5', 'A4', 'B1', 'B2',
                                  'B3', 'B4', 'C1', 'C2', 'C3', 'C4', 'D2',
                                  'D3', 'D4', 
                            ],
        ];

        foreach ($datos as $marca => $tonos) {
            foreach ($tonos as $tono) {
                DB::table('tonos')->insert([
                    'id' => $tono,
                    'marca' => $marca
                ]);
            }
        }
    }
}
