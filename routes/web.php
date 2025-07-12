<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Models\Inventario;
use App\Models\Venta;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Redirección al login
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect('/login'))->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('dashboard/clear-records', [DashboardController::class, 'clearAllRecords'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.clear-records');

/*
|--------------------------------------------------------------------------
| Configuración de usuario (Volt)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Inventario
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('inventario')->name('inventario.')->group(function () {
    
    // Lista de inventario
    Route::get('/', function () {
        $inventario = Inventario::all();
        return view('inventario', ['inventario' => $inventario]);
    })->name('index');

    // Editar inventario
    Route::get('{inventario}/edit', function (Inventario $inventario) {
        return view('inventario.edit', ['inventario' => $inventario]);
    })->name('edit');

    // Actualizar inventario
    Route::put('{inventario}', function (Inventario $inventario) {
        $validated = request()->validate([
            'cantidad' => 'required|integer|min:1',
            'costo' => 'required|numeric|min:0.01',
            'fecha' => 'nullable|date',
            'producto' => 'required|string',
        ]);

        $inventario->producto = $validated['producto'];
        $inventario->cantidad = $validated['cantidad'];
        $inventario->costo = $validated['costo'];
        if ($validated['fecha']) {
            $inventario->fecha = $validated['fecha'];
        }
        $inventario->save();

        return redirect()->route('inventario.index')->with('success', 'Inventario actualizado exitosamente');
    })->name('update');

    // Eliminar inventario
    Route::delete('{inventario}', function (Inventario $inventario) {
        $inventario->delete();
        return redirect()->route('inventario.index');
    })->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Compras
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('compras', 'compras')->name('compras.index');

    Route::post('compras', function () {
        $validated = request()->validate([
            'cantidad' => 'required|integer|min:1',
            'costo' => 'required|numeric|min:0.01',
            'producto' => 'required|string',
            'fecha' => 'nullable|date',
        ], [
            'producto.required' => 'El nombre del producto es obligatorio.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',
            'costo.required' => 'El precio es obligatorio.',
            'costo.numeric' => 'El precio debe ser un número.',
            'costo.min' => 'El precio debe ser al menos 0.01.',
        ]);

        Inventario::create([
            'producto' => $validated['producto'],
            'cantidad' => $validated['cantidad'],
            'costo' => $validated['costo'],
            'fecha' => $validated['fecha'] ? date('Y-m-d', strtotime($validated['fecha'])) : date('Y-m-d'),
        ]);

        return redirect()->route('compras.index')->with('success', 'Agregado exitosamente al inventario');
    })->name('compras.store');
});

/*
|--------------------------------------------------------------------------
| Ventas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('ventas')->name('ventas.')->group(function () {

    // Lista de ventas
    Route::get('/', function () {
        $ventas = Venta::all();
        return view('ventas', ['ventas' => $ventas]);
    })->name('index');

    // Crear venta
    Route::post('/', function () {
        $validated = request()->validate([
            'cantidad' => 'required|numeric',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'tipo_fruta' => 'required|string',
            'toppings' => 'required|array',
            'toppings.*' => 'string',
            'untable' => 'required|string',
            'medida' => 'required|string',
            'precio' => 'required|numeric',
            'horario' => 'nullable|string',
            'fecha' => 'nullable|date',
            'nombre' => 'required|string',
        ]);

        $venta = new Venta();
        $venta->cantidad = $validated['cantidad'];
        $venta->direccion = $validated['direccion'];
        $venta->telefono = $validated['telefono'];
        $venta->tipo_fruta = $validated['tipo_fruta'];
        $venta->toppings = json_encode($validated['toppings']);
        $venta->untable = $validated['untable'];
        $venta->medida = $validated['medida'];
        $venta->precio = $validated['precio'];
        $venta->horario = $validated['horario'] ?? null;
        $venta->fecha = $validated['fecha'] ?? null;
        $venta->nombre = $validated['nombre'];
        $venta->save();

        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente');
    })->name('store');

    // Editar venta
    Route::get('{venta}/edit', function (Venta $venta) {
        return view('ventas.edit', ['venta' => $venta]);
    })->name('edit');

    // Actualización parcial (vendido)
    Route::put('{venta}', function (Venta $venta) {
        request()->validate([
            'fecha' => 'nullable|date',
        ]);

        $venta->vendido = request('vendido', 0);
        $venta->save();

        return response()->json(['success' => true]);
    })->name('update');

    // Actualización completa
    Route::put('{venta}/full', function (Venta $venta) {
        $validated = request()->validate([
            'cantidad' => 'required|numeric',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'tipo_fruta' => 'required|string',
            'toppings' => 'required|array',
            'toppings.*' => 'string',
            'untable' => 'required|string',
            'medida' => 'required|string',
            'precio' => 'required|numeric',
            'horario' => 'nullable|string',
            'fecha' => 'nullable|date',
            'nombre' => 'required|string',
        ]);

        $venta->cantidad = $validated['cantidad'];
        $venta->direccion = $validated['direccion'];
        $venta->telefono = $validated['telefono'];
        $venta->tipo_fruta = $validated['tipo_fruta'];
        $venta->toppings = json_encode($validated['toppings']);
        $venta->untable = $validated['untable'];
        $venta->medida = $validated['medida'];
        $venta->precio = $validated['precio'];
        $venta->horario = $validated['horario'] ?? null;
        $venta->fecha = $validated['fecha'] ?? null;
        $venta->nombre = $validated['nombre'];
        $venta->save();

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente');
    })->name('updateFull');

    // Eliminar venta
    Route::delete('{venta}', function (Venta $venta) {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente');
    })->name('destroy');
});
