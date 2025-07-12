<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ventas') }}
        </h2>
    </x-slot>

    <div class="ventas py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold text-pink-700 dark:text-pink-300 mb-6">Venta</h3>

                    <form id="ventasForm" method="POST" action="{{ route('ventas.store') }}"
                          class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @csrf
                        <div class="sm:col-span-2">
                            <h3 class="text-2xl font-semibold text-pink-700 dark:text-pink-300 mb-6">
                                Información de Venta
                            </h3>
                        </div>

                        <!-- Cantidad -->
                        <div>
                            <label for="cantidad"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            <div id="cantidad-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        <!-- Nombre -->
                        <div>
                            <label for="nombre"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Nombre:</label>
                            <input type="text" id="nombre" name="nombre"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            <div id="nombre-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        <!-- Dirección -->
                        <div>
                            <label for="direccion"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Dirección:</label>
                            <input type="text" id="direccion" name="direccion"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            <div id="direccion-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        <!-- Tipo de Fruta -->
                        <div>
                            <label class="block text-lg font-medium text-pink-700 dark:text-pink-300">Tipo de Fruta:</label>
                            <div class="flex flex-col space-y-2 mt-2">
                                @foreach (['Fresa', 'Melocotón', 'Banano'] as $fruta)
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" class="fruta w-6 h-6 text-pink-600 focus:ring-pink-500 border-gray-300 rounded"
                                               name="tipo_fruta[]" value="{{ $fruta }}">
                                        <span class="text-lg">{{ $fruta }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div id="tipo_fruta-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label for="telefono"
                                   class="block text-lg font-medium text-pink-700 dark:text-pink-300">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            <div id="telefono-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        

                        <!-- Medida -->
                        <div>
                            <label for="medida" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Medida:</label>
                            <select id="medida" name="medida"
                                    class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
                                <option value="">Seleccione una medida</option>
                                <option value="12 Onzas">12 Onzas</option>
                                <option value="16 Onzas">16 Onzas</option>
                            </select>
                            <div id="medida-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        <!-- Toppings -->
                        <div>
                            <label class="block text-lg font-medium text-pink-700 dark:text-pink-300">Toppings:</label>
                            <div class="flex flex-col space-y-2 mt-2">
                                @foreach (['Granola', 'Oreo', 'Chispas', 'Hersheys', 'Coco Rallado', 'Botoneta', 'Manía', 'Anicillo', 'Almendra', 'Caramelo'] as $topping)
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" class="topping w-6 h-6 text-pink-600 focus:ring-pink-500 border-gray-300 rounded"
                                               name="toppings[]" value="{{ $topping }}">
                                        <span class="text-lg">{{ $topping }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div id="toppings-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        <!-- Untable -->
                        <div>
                            <label for="untable" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Untable:</label>
                            <select id="untable" name="untable"
                                    class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
                                <option value="Nutella">Nutella</option>
                                <option value="Leche condensada">Leche condensada</option>
                            </select>
                            <div id="untable-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        <!-- Precio -->
                        <div>
                            <label for="precio" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Precio:</label>
                            <select id="precio" name="precio"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
                                <option value="">Seleccione un precio</option>
                                <option value="25">Q25</option>
                                <option value="35">Q35</option>
                            </select>
                            <div id="precio-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        <!-- Horario -->
                        <div>
                            <label for="horario" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Horario:</label>
                            <input type="text" id="horario" name="horario"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                            <div id="horario-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        <!-- Fecha -->
                        <div>
                            <label for="fecha" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Fecha:</label>
                            <input type="date" id="fecha" name="fecha"
                                   class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3"
                                   value="{{ date('Y-m-d') }}">
                            <div id="fecha-error" class="error-message hidden mt-1 text-red-600 text-sm font-medium"></div>
                        </div>

                        <!-- Botón Guardar -->
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
                                        @foreach (['Cantidad', 'Nombre', 'Dirección', 'Teléfono', 'Tipo de Fruta', 'Toppings', 'Untable', 'Medida', 'Precio', 'Horario', 'Fecha', 'Vendido', 'Editar', 'Eliminar'] as $col)
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
                                                @if($venta->tipo_fruta)
                                                    {{ implode(', ', $venta->tipo_fruta) }}
                                                @endif
                                            </td>
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
                                            <td class="px-4 py-2 text-center align-middle">
                                                <input type="checkbox"
                                                       onchange="toggleVendido({{ $venta->id }}, this, this.closest('tr'))"
                                                       {{ $venta->vendido ? 'checked' : '' }}
                                                       class="rounded text-indigo-600 shadow-sm dark:bg-gray-800 dark:border-gray-700"
                                                       style="width: 2rem; height: 2rem; accent-color: #db2777; display: inline-block; vertical-align: middle; cursor: pointer;">
                                            </td>
                                            <td class="px-4 py-2 no-line-through">
                                                <a href="{{ route('ventas.edit', $venta->id) }}"
                                                   class="w-full inline-block text-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-md shadow focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-colors duration-200"
                                                   style="min-width: 100px;">
                                                    Editar
                                                </a>
                                            </td>
                                            <td class="px-4 py-2 no-line-through">
                                                <form method="POST" action="{{ route('ventas.destroy', $venta->id) }}" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta venta?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="w-full inline-block text-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded-md shadow focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-colors duration-200"
                                                            style="min-width: 100px;">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .line-through-row {
            text-decoration: line-through;
        }
        
        .error-alert {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 20%, 40%, 60%, 80% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
        }
    </style>

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

            // ===== NUEVA VALIDACIÓN CON ALERTAS ROJAS =====
            const form = document.getElementById('ventasForm');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevenir envío inicial para validar
                
                // Limpiar errores previos
                clearErrors();
                
                let hasErrors = false;
                
                // Validar campos requeridos
                const requiredFields = [
                    { id: 'cantidad', message: 'La cantidad es requerida' },
                    { id: 'nombre', message: 'El nombre es requerido' },
                    { id: 'direccion', message: 'La dirección es requerida' },
                    { id: 'medida', message: 'Debe seleccionar una medida' },
                    { id: 'precio', message: 'El precio es requerido' },
                    { id: 'horario', message: 'El horario es requerido' },
                    { id: 'fecha', message: 'La fecha es requerida' }
                ];
                
                // Validar campos de texto y números
                requiredFields.forEach(field => {
                    const element = document.getElementById(field.id);
                    const value = element.value.trim();
                    
                    if (!value) {
                        showError(field.id, field.message);
                        hasErrors = true;
                    } else if (field.id === 'cantidad' || field.id === 'precio') {
                        // Validar que sean números positivos
                        if (parseFloat(value) <= 0) {
                            showError(field.id, `${field.id === 'cantidad' ? 'La cantidad' : 'El precio'} debe ser mayor a 0`);
                            hasErrors = true;
                        }
                    } else if (field.id === 'telefono') {
                        // Validar formato de teléfono (ejemplo básico)
                        if (!/^\d{8,15}$/.test(value.replace(/[\s\-\(\)]/g, ''))) {
                            showError(field.id, 'Ingrese un teléfono válido');
                            hasErrors = true;
                        }
                    }
                });
                
                // Validar que al menos un tipo de fruta esté seleccionado
                const frutas = document.querySelectorAll('input[name="tipo_fruta[]"]:checked');
                if (frutas.length === 0) {
                    showError('tipo_fruta', 'Debe seleccionar al menos un tipo de fruta');
                    hasErrors = true;
                }
                
                // Validar que al menos un topping esté seleccionado
                const toppings = document.querySelectorAll('input[name="toppings[]"]:checked');
                if (toppings.length === 0) {
                    showError('toppings', 'Debe seleccionar al menos un topping');
                    hasErrors = true;
                }
                
                // Si no hay errores, enviar el formulario
                if (!hasErrors) {
                    // Remover el event listener para evitar bucle infinito
                    this.removeEventListener('submit', arguments.callee);
                    // Enviar el formulario
                    this.submit();
                }
            });
            
            // Limpiar errores cuando el usuario comience a escribir
            document.querySelectorAll('input, select').forEach(element => {
                element.addEventListener('input', function() {
                    const errorDiv = document.getElementById(this.id + '-error');
                    if (errorDiv && !errorDiv.classList.contains('hidden')) {
                        errorDiv.classList.add('hidden');
                        // Restaurar estilos del campo
                        this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                        if (this.id === 'medida' || this.id === 'precio' || this.id === 'horario' || this.id === 'fecha') {
                            this.classList.add('focus:border-indigo-500', 'focus:ring-indigo-500');
                        } else {
                            this.classList.add('border-pink-300', 'focus:border-pink-500', 'focus:ring-pink-500');
                        }
                    }
                });
            });
            
            // Limpiar error de toppings cuando se seleccione alguno
            document.querySelectorAll('input[name="toppings[]"]').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const toppingsError = document.getElementById('toppings-error');
                    const checkedToppings = document.querySelectorAll('input[name="toppings[]"]:checked');
                    
                    if (checkedToppings.length > 0 && !toppingsError.classList.contains('hidden')) {
                        toppingsError.classList.add('hidden');
                    }
                });
            });
        });

        function showError(fieldId, message) {
            const errorDiv = document.getElementById(fieldId + '-error');
            const inputElement = document.getElementById(fieldId);
            
            if (errorDiv) {
                errorDiv.textContent = message;
                errorDiv.classList.remove('hidden');
                errorDiv.classList.add('error-alert');
            }
            
            // Agregar borde rojo al campo
            if (inputElement) {
                inputElement.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                inputElement.classList.remove('border-pink-300', 'focus:border-pink-500', 'focus:ring-pink-500', 'focus:border-indigo-500', 'focus:ring-indigo-500');
            }
        }
        
        function clearErrors() {
            // Ocultar todos los mensajes de error
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(error => {
                error.classList.add('hidden');
                error.classList.remove('error-alert');
            });
            
            // Remover estilos de error de todos los inputs
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                // Restaurar estilos originales basados en el tipo de campo
                if (input.id === 'medida' || input.id === 'precio' || input.id === 'horario' || input.id === 'fecha') {
                    input.classList.add('focus:border-indigo-500', 'focus:ring-indigo-500');
                } else {
                    input.classList.add('border-pink-300', 'focus:border-pink-500', 'focus:ring-pink-500');
                }
            });
        }

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
</x-layouts.app>