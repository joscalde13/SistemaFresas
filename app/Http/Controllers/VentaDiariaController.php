<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\VentaDiaria;
use App\Models\DetalleVentaDiaria;
use Illuminate\Support\Facades\DB;

class VentaDiariaController extends Controller
{
    public function guardarVentaDiaria()
    {
        DB::transaction(function () {
            $ventas = Venta::all();
            if ($ventas->isEmpty()) {
                return back()->with('error', 'No hay ventas para guardar.');
            }

            // Calcular el total sumando cantidad * precio de cada venta
            $total = $ventas->reduce(function ($carry, $venta) {
                return $carry + ($venta->cantidad * $venta->precio);
            }, 0);

            $fecha = now()->toDateString();

            $ventaDiaria = VentaDiaria::create([
                'fecha' => $fecha,
                'total' => $total,
            ]);

            foreach ($ventas as $venta) {
                DetalleVentaDiaria::create([
                    'venta_diaria_id' => $ventaDiaria->id,
                    'producto' => $venta->nombre,
                    'cantidad' => $venta->cantidad,
                    'precio' => $venta->precio,
                    'subtotal' => $venta->cantidad * $venta->precio,
                ]);
            }

            Venta::truncate();
        });

        return redirect()->route('ventas_diarias.index')->with('success', 'Venta diaria guardada.');
    }

    public function index()
    {
        $ventasDiarias = VentaDiaria::with('detalles')->orderBy('fecha', 'desc')->get();
        $ventasPorMes = $ventasDiarias->groupBy(function($item) {
            return \Carbon\Carbon::parse($item->fecha)->format('Y-m');
        });
        return view('ventas_diarias.index', compact('ventasPorMes'));
    }

    public function grafica()
    {
        $data = VentaDiaria::select('fecha', DB::raw('SUM(total) as total'))
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        return response()->json($data);
    }

    public function eliminarTodas()
    {
        \App\Models\DetalleVentaDiaria::truncate();
        \App\Models\VentaDiaria::truncate();
        return redirect()->route('ventas_diarias.index')->with('success', 'Todas las ventas diarias han sido eliminadas.');
    }
}
