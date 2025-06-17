<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Compras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="compras bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-pink-700 dark:text-pink-300">Compra</h3>
                    
                   
                    
                    
                    <form method="POST" action="{{ route('compras.store') }}" class="grid grid-cols-2 gap-4">
                        @csrf
                        <div class="col-span-1 mb-4">
                            <label for="compra_nombre" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Nombre del producto:</label>
                            <input type="text" id="compra_nombre" name="nombre" class="mt-1 block w-full rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 border border-black thick-border p-2" value="{{ old('nombre') }}">
                            @error('nombre')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1 mb-4">
                            <label for="compra_precio" class="block text-lg font-medium text-pink-700 dark:text-pink-300">Precio (Q):</label>
                            <input type="text" id="compra_precio" name="costo" step="0.01" class="mt-1 block w-full rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 p-2" value="{{ old('costo') }}">
                            @error('costo')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1 mb-4">
                            <label for="compra_cantidad" class="block text-lg font-medium text-pink-700 dark:text-gray-300">Cantidad:</label>
                            <input type="number" id="compra_cantidad" name="cantidad" class="mt-1 block w-full rounded-md border-pink-300 dark:border-gray-700 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg dark:bg-gray-800 dark:text-gray-200 p-2" value="{{ old('cantidad') }}">
                            @error('cantidad')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-span-1"></div>
                        <div class="col-span-2">
                            <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-pink-600 dark:bg-pink-500 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-pink-700 dark:hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">Guardar Compra</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
                        <div class="  bg-green-200 border border-green-500 text-green-700 px-4 py-2 rounded shadow-md animate-bounce">
                            {{ session('success') }}
                        </div>
                    @endif
</x-layouts.app>
