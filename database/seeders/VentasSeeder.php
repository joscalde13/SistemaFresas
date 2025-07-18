<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;

class VentasSeeder extends Seeder
{
    public function run(): void
    {
        Venta::truncate();

        $productos = [
            'Fresa con crema', 'Fresa natural', 'Fresa con chocolate', 'Fresa mixta', 'Fresa premium',
            'Fresa tropical', 'Fresa deluxe', 'Fresa especial', 'Fresa light', 'Fresa tentación'
        ];

        $fechas = [
            '2025-07-05',
            '2025-08-05',
            '2025-09-05',
            '2025-10-05',
            '2025-11-05',
        ];

        $ventas = [];

        foreach ($fechas as $fecha) {
            for ($i = 1; $i <= 5; $i++) {
                $producto = $productos[array_rand($productos)];
                $ventas[] = [
                    'cantidad'    => 1,
                    'nombre'      => $producto,
                    'direccion'   => 'Zona ' . rand(1, 10),
                    'telefono'    => '5555-' . rand(1000, 9999),
                    'toppings'    => 'Topping ' . rand(1, 5),
                    'untable'     => 'Untable ' . rand(1, 3),
                    'medida'      => ['Pequeño', 'Mediano', 'Grande'][array_rand(['Pequeño', 'Mediano', 'Grande'])],
                    'precio'      => 25,
                    'vendido'     => false,
                    'fecha'       => $fecha,
                    'created_at'  => $fecha . ' ' . rand(8, 20) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ':00',
                    'updated_at'  => $fecha . ' ' . rand(8, 20) . ':' . str_pad(rand(0, 59), 2, '0', STR_PAD_LEFT) . ':00',
                ];
            }
        }

        Venta::insert($ventas);
    }
} 