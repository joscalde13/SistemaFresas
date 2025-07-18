<x-layouts.app>
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-pink-700 mb-8 text-center">Historial de Ventas Diarias</h1>
    <div class="flex justify-end mb-4">
        <form action="{{ route('ventas_diarias.eliminar_todas') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar TODAS las ventas diarias? Esta acción no se puede deshacer.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded shadow">Eliminar todas las ventas diarias</button>
        </form>
    </div>
    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300 text-center">
            {{ session('success') }}
        </div>
    @endif
    @php
        // Ordenar los meses y los días dentro de cada mes
        $ventasPorMes = collect($ventasPorMes)->sortKeys();
        $ventasPorMes = $ventasPorMes->map(function($ventasDiarias) {
            return $ventasDiarias->sortBy('fecha');
        });
        $meses_es = [
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
            '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
            '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        ];
    @endphp
    @forelse($ventasPorMes as $mes => $ventasDiarias)
        @php
            $anio = substr($mes, 0, 4);
            $numMes = substr($mes, 5, 2);
            $nombreMes = $meses_es[$numMes] ?? $numMes;
        @endphp
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-pink-700 mb-4 mt-8">{{ $nombreMes . ' ' . $anio }}</h2>
            <div class="overflow-x-auto rounded-lg shadow-lg bg-white dark:bg-zinc-900">
                <table class="min-w-full divide-y divide-pink-200 dark:divide-zinc-700">
                    <thead class="bg-pink-600 dark:bg-pink-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Total del día</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Detalle</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-zinc-900 divide-y divide-pink-100 dark:divide-zinc-800">
                        @foreach($ventasDiarias as $venta)
                        <tr class="hover:bg-pink-50 dark:hover:bg-zinc-800 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-pink-900 dark:text-pink-200 font-semibold align-top">{{ $venta->fecha }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-green-700 dark:text-green-300 font-bold align-top">
                                Q{{ number_format($venta->total, 2) }}
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-green-700 dark:text-green-300">
                                Q{{ number_format($venta->total, 2) }}<br>
                                <span class="text-xs text-zinc-500 dark:text-zinc-400 font-normal">Pedidos: {{ $venta->detalles->count() }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6 flex justify-center">
                <div class="px-8 py-4 rounded-lg bg-pink-100 dark:bg-pink-900 border-2 border-pink-400 dark:border-pink-700 text-2xl font-bold text-pink-800 dark:text-pink-200 shadow">
                    Total vendido en el mes: <span class="text-green-700 dark:text-green-300">Q{{ number_format($ventasDiarias->sum('total'), 2) }}</span>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center text-zinc-400">No hay ventas diarias registradas.</div>
    @endforelse
</div>
</x-layouts.app> 