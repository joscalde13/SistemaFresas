<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentasSencillasController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ventas-sencillas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric',
        ]);

        Venta::create([
            'cantidad' => $validated['cantidad'],
            'precio' => $validated['precio'],
            'nombre' => 'Venta Rápida',
            'direccion' => 'N/A',
            'telefono' => 'N/A',
            'toppings' => json_encode([]),
            'untable' => 'N/A',
            'medida' => 'N/A',
            'fecha' => now(),
        ]);

        return redirect()->route('ventas-sencillas.create')->with('success', 'Venta registrada exitosamente.');
    }
}
