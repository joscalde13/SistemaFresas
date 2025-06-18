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

                    <form method="POST" action="{{ route('ventas.store') }}"
                          class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @csrf
                        <div class="sm:col-span-2">
                            <h3 class="text-2xl font-semibold text-pink-700 dark:text-pink-300 mb-6">
                                Información de Venta
                            </h3>
                        </div>

                        <div>
                            <label for="cantidad"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
                            <label for="nombre"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Nombre:</label>
                            <input type="text" id="nombre" name="nombre"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
                            <label for="direccion"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Dirección:</label>
                            <input type="text" id="direccion" name="direccion"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
                            <label for="telefono"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
                            <label for="medida" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Medida:</label>
                            <select id="medida" name="medida"
                                    class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
                                <option value="">Seleccione una medida</option>
                                <option value="12 Onzas">12 Onzas</option>
                                <option value="16 Onzas">16 Onzas</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-lg font-medium text-pink-700 dark:text-pink-300">Toppings:</label>
                            <div class="flex flex-col space-y-2 mt-2">
                                @foreach (['Granola', 'Oreo', 'Chispas', 'Hersheys'] as $topping)
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" class="topping w-6 h-6 text-pink-600 focus:ring-pink-500 border-gray-300 rounded"
                                               name="toppings[]" value="{{ $topping }}">
                                        <span class="text-lg">{{ $topping }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label for="untable" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Untable:</label>
                            <select id="untable" name="untable"
                                    class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
                                <option value="Nutella">Nutella</option>
                                <option value="Leche condensada">Leche condensada</option>
                            </select>
                        </div>

                        <div>
                            <label for="precio" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Precio:</label>
                            <input type="number" id="precio" name="precio"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
                            <label for="horario" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Horario:</label>
                            <input type="text" id="horario" name="horario"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
                            <label for="fecha" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Fecha:</label>
                            <input type="date" id="fecha" name="fecha"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3"
                                   value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="col-span-1 sm:col-span-2">
                            <button type="submit"
                                    class="w-full sm:w-auto px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-md shadow focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                Guardar Venta
                            </button>
                        </div>
                    </form>

                    <!-- Tabla -->
                    <div class="mt-12">
                        <h3 class="text-2xl font-semibold text-pink-700 dark:text-pink-300 mb-4">Pedidos</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        @foreach (['Cantidad', 'Nombre', 'Dirección', 'Teléfono', 'Toppings', 'Untable', 'Medida', 'Precio', 'Horario', 'Fecha', 'Vendido', 'Editar', 'Eliminar'] as $col)
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">{{ $col }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($ventas as $venta)
                                        <tr class="{{ $venta->vendido ? 'line-through-row' : '' }}">
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->cantidad }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->nombre }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->direccion }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->telefono }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                                @if($venta->toppings)
                                                    {{ implode(', ', json_decode($venta->toppings) ?? []) }}
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->untable }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->medida }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">Q {{ $venta->precio }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ $venta->horario ?? '' }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300">{{ date('d-m-Y', strtotime($venta->fecha)) }}</td>
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
                                                <form method="POST" action="{{ route('ventas.destroy', $venta->id) }}" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta venta?');">
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

                    <!-- Script -->
                   <script>
    document.addEventListener('DOMContentLoaded', function () {
        const medidaSelect = document.getElementById('medida');
        const checkboxes = document.querySelectorAll('input[name="toppings[]"]');
        let maxToppings = 0;

        function updateToppingsAvailability() {
            const medida = medidaSelect.value;

            if (medida === '16 Onzas') {
                maxToppings = 2;
            } else if (medida === '12 Onzas') {
                maxToppings = 1;
            } else {
                maxToppings = 0;
            }

            checkboxes.forEach(cb => {
                cb.disabled = maxToppings === 0;
            });
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                let checkedCount = 0;
                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        checkedCount++;
                    }
                });

                if (checkedCount > maxToppings) {
                    cb.checked = false;
                    alert(`Solo puedes seleccionar ${maxToppings} topping${maxToppings > 1 ? 's' : ''} para esta medida.`);
                }
            });
        });

        medidaSelect.addEventListener('change', updateToppingsAvailability);

        document.querySelectorAll('input[type="checkbox"]').forEach(c => c.checked = false);

        updateToppingsAvailability(); // Ejecutar al cargar la página
    });

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
            body: JSON.stringify({
                vendido: checkbox.checked ? 1 : 0
            })
        })
        .then(response => {
            if (response.ok) {
                // Recargar la página para reflejar los cambios
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
<style>
    .line-through-row {
        text-decoration: line-through;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            const cantidad = document.getElementById('cantidad').value;
            const nombre = document.getElementById('nombre').value;
            const direccion = document.getElementById('direccion').value;
            const telefono = document.getElementById('telefono').value;
            const medida = document.getElementById('medida').value;
            const toppings = document.querySelectorAll('input[name="toppings[]"]:checked');
            const untable = document.getElementById('untable').value;
            const precio = document.getElementById('precio').value;
            const horario = document.getElementById('horario').value;
            const fecha = document.getElementById('fecha').value;

            let errorMessage = '';

            if (!cantidad) {
                errorMessage += 'Por favor, ingrese la cantidad.\n';
            }
            if (!nombre) {
                errorMessage += 'Por favor, ingrese el nombre.\n';
            }
            if (!direccion) {
                errorMessage += 'Por favor, ingrese la dirección.\n';
            }
            if (!telefono) {
                errorMessage += 'Por favor, ingrese el teléfono.\n';
            }
            if (!medida) {
                errorMessage += 'Por favor, seleccione una medida.\n';
            }
            if (toppings.length === 0) {
                errorMessage += 'Por favor, seleccione al menos un topping.\n';
            }
            if (!untable) {
                errorMessage += 'Por favor, seleccione un untable.\n';
            }
            if (!precio) {
                errorMessage += 'Por favor, ingrese el precio.\n';
            }
            if (!horario) {
                errorMessage += 'Por favor, ingrese el horario.\n';
            }
            if (!fecha) {
                errorMessage += 'Por favor, ingrese la fecha.\n';
            }

            if (errorMessage !== '') {
                event.preventDefault();
                alert(errorMessage);
            }
        });
    });
</script>
</final_file_content>

