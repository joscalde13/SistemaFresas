<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ventas Sencillas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold text-pink-700 dark:text-pink-300 mb-6">Venta Rápida</h3>

                    <form method="POST" action="{{ route('ventas-sencillas.store') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @csrf

                        <!-- Cantidad -->
                        <div>
                            <label for="cantidad" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad" required autofocus class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <!-- Precio -->
                        <div>
                            <label for="precio" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Precio:</label>
                            <div class="relative">
                                <select id="precio_select" class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-3" onchange="toggleCustomInput()">
                                    <option value="25">Q25</option>
                                    <option value="35">Q35</option>
                                    <option value="custom">Otro precio...</option>
                                </select>
                                <input type="number" id="precio" name="precio" required class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3 hidden">
                            </div>
                        </div>

                        <script>
                        function toggleCustomInput() {
                            const select = document.getElementById('precio_select');
                            const input = document.getElementById('precio');
                            
                            if (select.value === 'custom') {
                                select.classList.add('hidden');
                                input.classList.remove('hidden');
                                input.focus();
                                input.value = '';
                            } else {
                                input.value = select.value;
                            }
                        }
                        
                        // Initialize with first option selected
                        document.getElementById('precio').value = '25';
                        </script>

                        <!-- Botón Guardar -->
                        <div class="col-span-1 sm:col-span-2">
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-md shadow focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                Guardar Venta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>