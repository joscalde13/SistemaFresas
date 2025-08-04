<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener ventas agrupadas por día
        $ventasPorDia = Venta::whereNotNull('fecha')->where('fecha', '!=', '')
            ->selectRaw('DATE(fecha) as fecha, SUM(cantidad * precio) as total_vendido, SUM(cantidad) as cantidad_vendida')
            ->groupBy(DB::raw('DATE(fecha)'))
            ->orderBy('fecha', 'desc')
            ->get();

        // Obtener inversiones agrupadas por día
        $inversionesPorDia = Inventario::whereNotNull('fecha')->where('fecha', '!=', '')
            ->selectRaw('DATE(fecha) as fecha, SUM(cantidad * costo) as total_invertido')
            ->groupBy(DB::raw('DATE(fecha)'))
            ->get()
            ->keyBy(function ($item) {
                return Carbon::parse($item->fecha)->toDateString();
            });

        // Mapear los datos para la vista
        $datosPorDia = $ventasPorDia->map(function ($venta) use ($inversionesPorDia) {
            $fecha = Carbon::parse($venta->fecha)->toDateString();
            $inversion = $inversionesPorDia->get($fecha);

            $totalInvertido = $inversion ? $inversion->total_invertido : 0;
            $ganancia = $venta->total_vendido - $totalInvertido;

            return (object)[
                'fecha' => $fecha,
                'total_vendido' => $venta->total_vendido,
                'cantidad_vendida' => $venta->cantidad_vendida,
                'total_invertido' => $totalInvertido,
                'ganancia' => $ganancia,
            ];
        });

        return view('dashboard', compact('datosPorDia'));
    }

    public function clearAllRecords()
    {
        try {
           
            Inventario::truncate();
            
           
            Venta::truncate();
            
            return redirect()->route('dashboard')->with('success', 'Todos los registros de inventario y ventas han sido eliminados exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Error al eliminar los registros: ' . $e->getMessage());
        }
    }
}
