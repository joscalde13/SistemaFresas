<x-layouts.app :title="__('Dashboard')">
    <div class="flex flex-col gap-6 p-6 max-w-7xl mx-auto">

        {{-- Mensajes de sesión --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Botón de eliminación --}}
        <div class="flex justify-end">
            <form action="{{ route('dashboard.clear-records') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar TODOS los registros de inventario y ventas? Esta acción no se puede deshacer.')">
                @csrf
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                    🗑️ Eliminar Todos los Registros
                </button>
            </form>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @php
                $totalVentas = $datosPorDia->sum('cantidad_vendida');
                $totalVendido = $datosPorDia->sum('total_vendido');
                $totalInvertido = $datosPorDia->sum('total_invertido');
                $totalGanancia = $datosPorDia->sum('ganancia');
            @endphp

            {{-- Tarjeta 1: Total de Ventas --}}
            <div class="bg-pink-100 dark:bg-pink-900 border border-pink-300 dark:border-pink-700 shadow-lg rounded-2xl p-6 text-center">
                <h3 class="text-base font-semibold text-pink-700 dark:text-pink-200">Total de Ventas</h3>
                <p class="text-3xl font-bold text-pink-900 dark:text-pink-100 mt-2">{{ $totalVentas }}</p>
            </div>

            {{-- Tarjeta 2: Precio Total de Ventas --}}
            <div class="bg-pink-100 dark:bg-pink-900 border border-pink-300 dark:border-pink-700 shadow-lg rounded-2xl p-6 text-center">
                <h3 class="text-base font-semibold text-pink-700 dark:text-pink-200">Precio Total de Ventas</h3>
                <p class="text-3xl font-bold text-pink-900 dark:text-pink-100 mt-2">Q {{ number_format($totalVendido, 2) }}</p>
            </div>

            {{-- Tarjeta 3: Ganancia Total --}}
            <div class="bg-pink-100 dark:bg-pink-900 border border-pink-300 dark:border-pink-700 shadow-lg rounded-2xl p-6 text-center">
                <h3 class="text-base font-semibold text-pink-700 dark:text-pink-200">Ganancia Total</h3>
                <p class="text-3xl font-bold text-pink-900 dark:text-pink-100 mt-2">Q {{ number_format($totalGanancia, 2) }}</p>
            </div>

            {{-- Tarjeta 4: Costo Total de Inversión --}}
            <div class="bg-pink-100 dark:bg-pink-900 border border-pink-300 dark:border-pink-700 shadow-lg rounded-2xl p-6 text-center">
                <h3 class="text-base font-semibold text-pink-700 dark:text-pink-200">Costo de Inversión</h3>
                <p class="text-3xl font-bold text-pink-900 dark:text-pink-100 mt-2">Q {{ number_format($totalInvertido, 2) }}</p>
            </div>
        </div>

        

        {{-- Ventas por Día --}}
        <div class="bg-white dark:bg-gray-900 border border-green-300 dark:border-green-700 rounded-2xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-green-700 dark:text-green-300 mb-4">Ventas por Día</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-green-200 dark:divide-green-800">
                    <thead class="bg-green-50 dark:bg-green-900">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-500 dark:text-green-300 uppercase tracking-wider">Fecha</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-500 dark:text-green-300 uppercase tracking-wider">Total Vendido</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-500 dark:text-green-300 uppercase tracking-wider">Cantidad Vendida</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-500 dark:text-green-300 uppercase tracking-wider">Total Invertido</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-green-500 dark:text-green-300 uppercase tracking-wider">Ganancia</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-green-200 dark:divide-green-700">
                        @if(count($datosPorDia))
                            @foreach ($datosPorDia as $dato)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($dato->fecha)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">Q {{ number_format($dato->total_vendido, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $dato->cantidad_vendida }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">Q {{ number_format($dato->total_invertido, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $dato->ganancia >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        Q {{ number_format($dato->ganancia, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500 dark:text-gray-400">No hay datos para mostrar.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
