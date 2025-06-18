<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Venta') }}
        </h2>
    </x-slot>

    <div class="ventas py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold text-pink-700 dark:text-pink-300 mb-6">Editar Venta</h3>

                    <form method="POST" action="{{ route('ventas.updateFull', $venta->id) }}"
                          class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="sm:col-span-2">
                            <h3 class="text-2xl font-semibold text-pink-700 dark:text-pink-300 mb-6">
                                Información de Venta
                            </h3>
                        </div>

                        <div>
                            <label for="cantidad"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad" value="{{ old('cantidad', $venta->cantidad) }}"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            @error('cantidad')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="nombre"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $venta->nombre) }}"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="direccion"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Dirección:</label>
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $venta->direccion) }}"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            @error('direccion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="telefono"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $venta->telefono) }}"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            @error('telefono')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="medida" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Medida:</label>
                            <select id="medida" name="medida"
                                    class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
                                <option value="">Seleccione una medida</option>
                                <option value="12 Onzas" {{ old('medida', $venta->medida) === '12 Onzas' ? 'selected' : '' }}>12 Onzas</option>
                                <option value="16 Onzas" {{ old('medida', $venta->medida) === '16 Onzas' ? 'selected' : '' }}>16 Onzas</option>
                            </select>
                            @error('medida')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-lg font-medium text-pink-700 dark:text-pink-300">Toppings:</label>
                            <div class="flex flex-col space-y-2 mt-2">
                                @php
                                    $selectedToppings = old('toppings', json_decode($venta->toppings, true) ?? []);
                                @endphp
                                @foreach (['Granola', 'Oreo', 'Chispas', 'Hersheys'] as $topping)
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" class="topping w-6 h-6 text-pink-600 focus:ring-pink-500 border-gray-300 rounded"
                                               name="toppings[]" value="{{ $topping }}"
                                               {{ in_array($topping, $selectedToppings) ? 'checked' : '' }}>
                                        <span class="text-lg">{{ $topping }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('toppings')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="untable" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Untable:</label>
                            <select id="untable" name="untable"
                                    class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
                                <option value="Nutella" {{ old('untable', $venta->untable) === 'Nutella' ? 'selected' : '' }}>Nutella</option>
                                <option value="Leche condensada" {{ old('untable', $venta->untable) === 'Leche condensada' ? 'selected' : '' }}>Leche condensada</option>
                            </select>
                            @error('untable')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="precio" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Precio:</label>
                            <input type="number" id="precio" name="precio" value="{{ old('precio', $venta->precio) }}"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            @error('precio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="horario" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Horario:</label>
                            <input type="text" id="horario" name="horario" value="{{ old('horario', $venta->horario) }}"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            @error('horario')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="fecha" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Fecha:</label>
                            <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $venta->fecha) }}"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            @error('fecha')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-1 sm:col-span-2 flex space-x-4">
                            <button type="submit"
                                    class="px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-md shadow focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                Actualizar Venta
                            </button>
                            <a href="{{ route('ventas.index') }}"
                               class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-md shadow focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
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

            // Ejecutar al cargar la página para establecer el estado inicial
            updateToppingsAvailability();
        });
    </script>

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
</x-layouts.app>