<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect('/login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::get('inventario', function () {
    $inventario = \App\Models\Inventario::all();
    return view('inventario', ['inventario' => $inventario]);
})->middleware(['auth', 'verified'])->name('inventario.index');

Route::delete('inventario/{inventario}', function (\App\Models\Inventario $inventario) {
    $inventario->delete();

    return redirect('/inventario');
})->middleware(['auth', 'verified'])->name('inventario.destroy');

Route::put('inventario/{inventario}', function (\App\Models\Inventario $inventario) {
    // Update the inventario item
    $validated = request()->validate([
        'nombre' => 'required|string|max:255',
        'cantidad' => 'required|integer|min:1',
        'costo' => 'required|numeric|min:0.01',
        'producto' => 'required|string|max:255',
    ]);

    $inventario->cantidad = $validated['cantidad'];
    $inventario->nombre = $validated['nombre'];
    $inventario->costo = $validated['costo'];
    $inventario->producto = $validated['producto'];
    $inventario->save();

    return redirect('/inventario')->with('success', 'Inventario actualizado exitosamente');
})->middleware(['auth', 'verified'])->name('inventario.update');

Route::get('inventario/{inventario}/edit', function (\App\Models\Inventario $inventario) {
    return view('inventario.edit', ['inventario' => $inventario]);
})->middleware(['auth', 'verified'])->name('inventario.edit');

Route::view('compras', 'compras')
    ->middleware(['auth', 'verified'])
    ->name('compras.index');

Route::post('compras', function () {
    $validated = request()->validate([
        'nombre' => 'required|string|max:255',
        'cantidad' => 'required|integer|min:1',
        'costo' => 'required|numeric|min:0.01',
    ], [
        'nombre.required' => 'El nombre del producto es obligatorio.',
        'cantidad.required' => 'La cantidad es obligatoria.',
        'cantidad.integer' => 'La cantidad debe ser un número entero.',
        'cantidad.min' => 'La cantidad debe ser al menos 1.',
        'costo.required' => 'El precio es obligatorio.',
        'costo.numeric' => 'El precio debe ser un número.',
        'costo.min' => 'El precio debe ser al menos 0.01.',
    ]);

    $validated['producto'] = $validated['nombre'];

    \App\Models\Inventario::create($validated);

    return redirect('/compras')->with('success', 'Agregado exitosamente al inventario');
})->middleware(['auth', 'verified'])->name('compras.store');

Route::get('ventas', function () {
    $ventas = \App\Models\Venta::all();
    return view('ventas', ['ventas' => $ventas]);
})->middleware(['auth', 'verified'])->name('ventas.index');

Route::post('ventas', function () {
    $request = request()->validate([
        'cantidad' => 'required|numeric',
        'nombre' => 'required|string',
        'direccion' => 'required|string',
        'telefono' => 'required|string',
        'toppings' => 'required|string',
        'untable' => 'required|string',
        'medida' => 'required|string',
        'precio' => 'required|numeric',
        'horario' => 'nullable|string',
    ]);

    $venta = new \App\Models\Venta();
    $venta->cantidad = $request['cantidad'];
    $venta->nombre = $request['nombre'];
    $venta->direccion = $request['direccion'];
    $venta->telefono = $request['telefono'];
    $venta->toppings = $request['toppings'];
    $venta->untable = $request['untable'];
    $venta->medida = $request['medida'];
    $venta->precio = $request['precio'];
    $venta->horario = $request['horario'];
    $venta->save();

    return redirect('/ventas');
})->middleware(['auth', 'verified'])->name('ventas.store');

Route::delete('ventas/{venta}', function (\App\Models\Venta $venta) {
    $venta->delete();

    return redirect('/ventas');
})->middleware(['auth', 'verified'])->name('ventas.destroy');

Route::put('ventas/{venta}', function (\App\Models\Venta $venta) {
    $venta->vendido = request('vendido', 0);
    $venta->save();

    return response()->json(['success' => true]);
})->middleware(['auth', 'verified'])->name('ventas.update');

Route::put('ventas/{venta}/full', function (\App\Models\Venta $venta) {
    $request = request()->validate([
        'cantidad' => 'required|numeric',
        'nombre' => 'required|string',
        'direccion' => 'required|string',
        'telefono' => 'required|string',
        'toppings' => 'required|string',
        'untable' => 'required|string',
        'medida' => 'required|string',
        'precio' => 'required|numeric',
        'horario' => 'nullable|string',
    ]);

    $venta->cantidad = $request['cantidad'];
    $venta->nombre = $request['nombre'];
    $venta->direccion = $request['direccion'];
    $venta->telefono = $request['telefono'];
    $venta->toppings = $request['toppings'];
    $venta->untable = $request['untable'];
    $venta->medida = $request['medida'];
    $venta->precio = $request['precio'];
    $venta->horario = $request['horario'];
    $venta->save();

    return redirect('/ventas')->with('success', 'Venta actualizada');
})->middleware(['auth', 'verified'])->name('ventas.updateFull');

Route::get('ventas/{venta}/edit', function (\App\Models\Venta $venta) {
    return view('ventas.edit', ['venta' => $venta]);
})->middleware(['auth', 'verified'])->name('ventas.edit');
