<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('inventarios')->insert([
            [
                'producto' => 'Fresa',
                'nombre' => 'Fresa Premium',
                'cantidad' => 100,
                'costo' => 2.50,
            ],
            [
                'producto' => 'Chocolate',
                'nombre' => 'Chocolate Belga',
                'cantidad' => 50,
                'costo' => 3.00,
            ],
            [
                'producto' => 'Vainilla',
                'nombre' => 'Vainilla Francesa',
                'cantidad' => 75,
                'costo' => 2.75,
            ],
        ]);
    }
}
