<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Inventario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Editar Inventario</h3>
                    <form method="POST" action="{{ route('inventario.update', $inventario->id) }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="col-span-2">
                            <label for="inventario_nombre" class="block text-base font-medium text-gray-700 dark:text-gray-300">Nombre del producto:</label>
                            <input type="text" id="inventario_nombre" name="nombre" value="{{ $inventario->nombre }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base dark:bg-gray-800 dark:text-gray-200">
                        </div>
                        <div class="col-span-2">
                            <label for="inventario_producto" class="block text-base font-medium text-gray-700 dark:text-gray-300">Producto:</label>
                            <input type="text" id="inventario_producto" name="producto" value="{{ $inventario->producto }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base dark:bg-gray-800 dark:text-gray-200">
                        </div>
                        <div class="col-span-2">
                            <label for="inventario_precio" class="block text-base font-medium text-gray-700 dark:text-gray-300">Precio (Q):</label>
                            <input type="text" id="inventario_precio" name="costo" step="0.01" value="{{ $inventario->costo }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base dark:bg-gray-800 dark:text-gray-200">
                        </div>
                        <div class="col-span-2">
                            <label for="inventario_cantidad" class="block text-base font-medium text-gray-700 dark:text-gray-300">Cantidad:</label>
                            <input type="number" id="inventario_cantidad" name="cantidad" value="{{ $inventario->cantidad }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base dark:bg-gray-800 dark:text-gray-200">
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 dark:bg-indigo-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
