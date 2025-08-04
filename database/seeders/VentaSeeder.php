<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;
use Carbon\Carbon;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Venta::truncate();
        $startDate = Carbon::create(2025, 8, 5);

        for ($i = 0; $i < 5; $i++) {
            $date = $startDate->copy()->addDays($i);

            Venta::create([
                'cantidad' => rand(1, 10),
                'nombre' => 'Cliente ' . ($i + 1),
                'direccion' => 'Dirección ' . ($i + 1),
                'telefono' => '1234567' . $i,
                'tipo_fruta' => ['Fresa', 'Piña'],
                'toppings' => ['Leche condensada', 'Chocolate'],
                'untable' => 'Nutella',
                'medida' => 'Grande',
                'precio' => rand(20, 50),
                'vendido' => rand(0, 1),
                'fecha' => $date->toDateString(),
            ]);
        }
    }
}
