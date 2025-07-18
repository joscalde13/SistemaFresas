<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VentaDiaria;
use App\Models\DetalleVentaDiaria;
use Carbon\Carbon;

class VentasDiariasSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar tablas
        DetalleVentaDiaria::truncate();
        VentaDiaria::truncate();

        $productos = [
            'Fresa con crema', 'Fresa natural', 'Fresa con chocolate', 'Fresa mixta', 'Fresa premium',
            'Fresa tropical', 'Fresa deluxe', 'Fresa especial', 'Fresa light', 'Fresa tentación'
        ];

        $fechas = [
            '2025-07-05', '2025-07-15', '2025-08-05', '2025-08-20', '2025-09-05',
            '2025-09-25', '2025-10-05', '2025-10-18', '2025-11-05', '2025-11-22'
        ];

        foreach ($fechas as $fecha) {
            $total = 0;
            $ventaDiaria = VentaDiaria::create([
                'fecha' => $fecha,
                'total' => 0, // se actualiza después
            ]);
            $numPedidos = rand(3, 7);
            for ($i = 0; $i < $numPedidos; $i++) {
                $cantidad = rand(1, 3);
                $precio = rand(15, 40);
                $subtotal = $cantidad * $precio;
                $total += $subtotal;
                DetalleVentaDiaria::create([
                    'venta_diaria_id' => $ventaDiaria->id,
                    'producto' => $productos[array_rand($productos)],
                    'cantidad' => $cantidad,
                    'precio' => $precio,
                    'subtotal' => $subtotal,
                ]);
            }
            $ventaDiaria->total = $total;
            $ventaDiaria->save();
        }
    }
} 