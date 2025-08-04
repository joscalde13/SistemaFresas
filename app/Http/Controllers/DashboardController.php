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
        $today = Carbon::today();
        $ventas = Venta::whereDate('fecha', $today)->get();

        $ventasDelDia = $ventas->count();
        $totalVendido = $ventas->sum('precio');
        $cantidadVendida = $ventas->sum('cantidad');

        $ventasPorDia = Venta::selectRaw('DATE(fecha) as fecha, SUM(precio) as total_vendido, SUM(cantidad) as cantidad_vendida')
            ->groupBy(DB::raw('DATE(fecha)'))
            ->orderBy('fecha', 'desc')
            ->get();

        return view('dashboard', compact('ventasDelDia', 'totalVendido', 'cantidadVendida', 'ventasPorDia'));
    }

    public function clearAllRecords()
    {
        try {
            // Eliminar todos los registros de inventario
            Inventario::truncate();
            
            // Eliminar todos los registros de ventas
            Venta::truncate();
            
            return redirect()->route('dashboard')->with('success', 'Todos los registros de inventario y ventas han sido eliminados exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Error al eliminar los registros: ' . $e->getMessage());
        }
    }
}
