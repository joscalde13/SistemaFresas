<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Venta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold text-pink-700 dark:text-pink-300 mb-6">Editar Venta</h3>

                    <form method="POST" action="{{ route('ventas.updateFull', $venta->id) }}" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @csrf
                        @method('PUT')

                        <div>
    <label for="venta_cantidad" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Cantidad:</label>
    <input
        type="number"
        id="venta_cantidad"
        name="cantidad"
        value="{{ old('cantidad', $venta->cantidad) }}"
        class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3"
    >
</div>


                        <div>
                            <label for="venta_nombre" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Nombre:</label>
                            <input type="text" id="venta_nombre" name="nombre" value="{{ $venta->nombre }}" class="border border-black w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
                            <label for="venta_direccion" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Dirección:</label>
                            <input type="text" id="venta_direccion" name="direccion" value="{{ $venta->direccion }}" class="border border-black w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
                            <label for="venta_telefono" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Teléfono:</label>
                            <input type="text" id="venta_telefono" name="telefono" value="{{ $venta->telefono }}" class="border border-black w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>

                        <div>
    <label for="venta_toppings" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Toppings:</label>
    <select id="venta_toppings" name="toppings"
        class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
        <option value="Granola" {{ $venta->toppings == 'Granola' ? 'selected' : '' }}>Granola</option>
        <option value="Oreo" {{ $venta->toppings == 'Oreo' ? 'selected' : '' }}>Oreo</option>
        <option value="Chispas" {{ $venta->toppings == 'Chispas' ? 'selected' : '' }}>Chispas</option>
        <option value="Hersheys" {{ $venta->toppings == 'hersheys' ? 'selected' : '' }}>Hersheys</option>
    </select>
</div>


                        <div>
    <label for="venta_untable" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Untable:</label>
    <select id="venta_untable" name="untable"
        class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
        <option value="Nutella" {{ $venta->untable == 'Nutella' ? 'selected' : '' }}>Nutella</option>
        <option value="Leche condensada" {{ $venta->untable == 'Leche condensada' ? 'selected' : '' }}>Leche condensada</option>
    </select>
</div>


                        <div>
    <label for="venta_medida" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Medida:</label>
    <select id="venta_medida" name="medida"
        class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xl dark:bg-gray-800 dark:text-gray-200 border p-4 h-14">
        <option value="12 Onzas" {{ $venta->medida == '12 Onzas' ? 'selected' : '' }}>12 Onzas</option>
        <option value="16 Onzas" {{ $venta->medida == '16 Onzas' ? 'selected' : '' }}>16 Onzas</option>
    </select>
</div>


                        <div>
                            <label for="venta_precio" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Precio:</label>
                            <input type="number" id="venta_precio" name="precio" value="{{ $venta->precio }}" class="border border-black w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3">
                        </div>


                        <div>
    <label for="venta_horario" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Horario:</label>
    <input
        type="text"
        id="venta_horario"
        name="horario"
        value="{{ old('horario', $venta->horario) }}"
        class="w-full mt-2 rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg dark:bg-gray-800 dark:text-gray-200 border p-3"
    >
</div>


                        <div class="col-span-1 sm:col-span-2">
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-md shadow focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
