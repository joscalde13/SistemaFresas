<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra;
use Carbon\Carbon;

class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Compra::truncate();
        $startDate = Carbon::create(2025, 8, 5);

        for ($i = 0; $i < 5; $i++) {
            $date = $startDate->copy()->addDays($i);

            Compra::create([
                'nombre' => 'Compra ' . ($i + 1),
                'producto' => 'Producto ' . ($i + 1),
                'cantidad' => rand(10, 50),
                'costo' => rand(5, 20),
                'fecha' => $date->toDateString(),
            ]);
        }
    }
}
