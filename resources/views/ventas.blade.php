<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ventas') }}
        </h2>
    </x-slot>

    <div class="ventas py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold text-pink-700 dark:text-pink-300 mb-6">Venta</h3>
                    
                    <form method="POST" action="{{ route('ventas.store') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @csrf
                        <div>
                            <label for="venta_cantidad" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Cantidad:</label>
                            <input type="number" id="venta_cantidad" name="cantidad" class=" border border-black w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3 ">
                        </div>

                        <div>
                            <label for="venta_nombre" class=" block text-lg font-medium text-pink-700 dark:text-pink-300">Nombre:</label>
                            <input type="text" id="venta_nombre" name="nombre" class="border border-black w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
                            <label for="venta_direccion" class=" block text-lg font-medium text-pink-700 dark:text-pink-300">Dirección:</label>
                            <input type="text" id="venta_direccion" name="direccion" class="border border-black w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>


                        <div>
                            <label for="venta_telefono" class=" block text-lg font-medium text-pink-700 dark:text-pink-300">Teléfono:</label>
                            <input type="text" id="venta_telefono" name="telefono" class="border border-black w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                       <div>
    <label for="venta_toppings" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Toppings:</label>
    <select id="venta_toppings" name="toppings"
        class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
        <option value="Granola">Granola</option>
        <option value="Oreo">Oreo</option>
        <option value="Chispas">Chispas</option>
        <option value="Hersheys">Hersheys</option>
    </select>
</div>

<div>
    <label for="venta_untable" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Untable:</label>
    <select id="venta_untable" name="untable"
        class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
        <option value="Nutella">Nutella</option>
        <option value="Leche condensada">Leche condensada</option>
    </select>
</div>

<div>
    <label for="venta_medida" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Medida:</label>
    <select id="venta_medida" name="medida"
        class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
        <option value="12 Onzas">12 Onzas</option>
        <option value="16 Onzas">16 Onzas</option>
     
    </select>
</div>


                        <div>
                            <label for="venta_precio" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Precio:</label>
                            <input type="number" id="venta_precio" name="precio" class="border border-black w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
                            <label for="venta_horario" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Horario:</label>
                            <input type="text" id="venta_horario" name="horario" class="border border-black w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div class="col-span-1 sm:col-span-2">
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-md shadow focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                Guardar Venta
                            </button>
                        </div>
                    </form>

                    <!-- Tabla de pedidos -->
                    <div class="mt-12">
                        <h3 class="text-2xl font-semibold text-pink-700 dark:text-pink-300 mb-4">Pedidos</h3>
                        <div class="overflow-x-auto">
                            <table class="ventas min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Cantidad</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nombre</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Dirección</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Teléfono</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Toppings</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Untable</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Medida</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Precio</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Horario</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Vendido</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Editar</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
    @foreach ($ventas as $venta)
        <tr class="{{ $venta->vendido ? 'line-through-row' : '' }}">
            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->cantidad }}</td>
            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->nombre }}</td>
            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->direccion }}</td>
            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->telefono }}</td>
            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->toppings }}</td>
            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->untable }}</td>
            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->medida }}</td>
            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Q {{ $venta->precio }}</td>
            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->horario ?? '' }}</td>
            <td class="px-4 py-2">
                <input type="checkbox"
                       onchange="toggleVendido({{ $venta->id }}, this, this.closest('tr'))"
                       {{ $venta->vendido ? 'checked' : '' }}
                       class="rounded text-indigo-600 shadow-sm dark:bg-gray-800 dark:border-gray-700 larger-checkbox">
            </td>
            <td class="px-4 py-2 no-line-through">
                <a href="{{ route('ventas.edit', $venta->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Editar</a>
            </td>
<td class="px-4 py-2 no-line-through">
                                                <form method="POST" action="{{ route('ventas.destroy', $venta->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Eliminar</button>
                                                </form>
                                            </td>
        </tr>
    @endforeach
</tbody>

                            </table>
                        </div>
                    </div>

                    <!-- Al final del archivo antes del cierre de </div> -->
<script>
    function toggleVendido(ventaId, checkbox, row) {
        // Aplica o quita la clase a la fila completa
        if (checkbox.checked) {
            row.classList.add('line-through-row');
        } else {
            row.classList.remove('line-through-row');
        }

        fetch('/ventas/' + ventaId, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ vendido: checkbox.checked ? 1 : 0 })
        })
        .then(response => {
            if (response.ok) {
                // Recargar la página para reflejar los cambios
                location.reload();
            } else {
                console.error('Error al actualizar el estado de vendido');
            }
        });
    }
</script>

                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
