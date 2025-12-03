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
                    
                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-bold text-pink-600 dark:text-pink-400"> Venta Rápida</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-base mt-2">Registra una venta en segundos</p>
                    </div>

                    <form method="POST" action="{{ route('ventas-sencillas.store') }}" class="max-w-xl mx-auto space-y-8">
                        @csrf

                        <!-- Cantidad con Botones -->
                        <div>
                            <label for="cantidad" class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-3 text-center">Cantidad</label>
                            <div class="flex justify-center items-center gap-4">
                                <button type="button" onclick="decrementQuantity()" class="w-12 h-12 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-pink-100 hover:text-pink-600 transition flex items-center justify-center text-2xl font-bold focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    -
                                </button>
                                <input type="number" id="cantidad" name="cantidad" value="1" required min="1"
                                    class="w-24 text-center text-2xl font-bold rounded-md border-gray-300 focus:border-pink-500 focus:ring-pink-500 dark:bg-gray-900 dark:border-gray-600 dark:text-white py-2">
                                <button type="button" onclick="incrementQuantity()" class="w-12 h-12 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-pink-100 hover:text-pink-600 transition flex items-center justify-center text-2xl font-bold focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    +
                                </button>
                            </div>
                        </div>

                        <!-- Precio con Botones de Selección -->
                        <div>
                            <label class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-3 text-center">Precio</label>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <button type="button" onclick="selectPrice(25)" id="btn-25" class="price-btn py-4 px-6 rounded-xl border-2 border-pink-500 bg-pink-50 text-pink-700 font-bold text-xl hover:bg-pink-100 transition focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    Q25.00
                                </button>
                                <button type="button" onclick="selectPrice(35)" id="btn-35" class="price-btn py-4 px-6 rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-bold text-xl hover:border-pink-300 hover:bg-pink-50 transition focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    Q35.00
                                </button>
                            </div>
                            
                            <!-- Opción de Otro Precio -->
                            <div class="text-center">
                                <button type="button" onclick="toggleCustomPrice()" id="btn-custom" class="text-sm text-gray-500 dark:text-gray-400 underline hover:text-pink-600 transition">
                                    Ingresar otro precio
                                </button>
                            </div>

                            <div id="custom_price_container" class="hidden mt-4">
                                <div class="relative rounded-md shadow-sm max-w-xs mx-auto">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span class="text-gray-500 sm:text-sm">Q</span>
                                    </div>
                                    <input type="number" id="custom_precio_input" 
                                        class="block w-full rounded-md border-gray-300 pl-7 focus:border-pink-500 focus:ring-pink-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600 dark:text-white py-2" 
                                        placeholder="0.00" oninput="updateHiddenPrice(this.value)">
                                </div>
                            </div>

                            <!-- Input oculto que se envía -->
                            <input type="hidden" id="precio" name="precio" value="25">
                        </div>

                        <script>
                            function incrementQuantity() {
                                const input = document.getElementById('cantidad');
                                input.value = parseInt(input.value) + 1;
                            }

                            function decrementQuantity() {
                                const input = document.getElementById('cantidad');
                                if (parseInt(input.value) > 1) {
                                    input.value = parseInt(input.value) - 1;
                                }
                            }

                            function selectPrice(price) {
                                // Update hidden input
                                document.getElementById('precio').value = price;
                                
                                // Reset custom input UI
                                document.getElementById('custom_price_container').classList.add('hidden');
                                document.getElementById('btn-custom').classList.remove('hidden');
                                document.getElementById('custom_precio_input').value = '';

                                // Update button styles
                                document.querySelectorAll('.price-btn').forEach(btn => {
                                    btn.classList.remove('border-pink-500', 'bg-pink-50', 'text-pink-700');
                                    btn.classList.add('border-gray-200', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');
                                });

                                const activeBtn = document.getElementById('btn-' + price);
                                if(activeBtn) {
                                    activeBtn.classList.remove('border-gray-200', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');
                                    activeBtn.classList.add('border-pink-500', 'bg-pink-50', 'text-pink-700');
                                }
                            }

                            function toggleCustomPrice() {
                                document.getElementById('custom_price_container').classList.remove('hidden');
                                document.getElementById('btn-custom').classList.add('hidden');
                                document.getElementById('custom_precio_input').focus();
                                
                                // Clear selection styles
                                document.querySelectorAll('.price-btn').forEach(btn => {
                                    btn.classList.remove('border-pink-500', 'bg-pink-50', 'text-pink-700');
                                    btn.classList.add('border-gray-200', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300');
                                });
                                
                                // Clear hidden input until typed
                                document.getElementById('precio').value = '';
                            }

                            function updateHiddenPrice(val) {
                                document.getElementById('precio').value = val;
                            }
                        </script>

                        <!-- Botón Guardar -->
                        <div class="pt-4">
                            <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-lg font-bold text-white bg-gradient-to-r from-pink-500 to-rose-600 hover:from-pink-600 hover:to-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-200 ease-in-out transform hover:scale-[1.02]">
                                Guardar Venta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>