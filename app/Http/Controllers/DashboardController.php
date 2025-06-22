<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Venta;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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