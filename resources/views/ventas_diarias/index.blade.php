<x-layouts.app>
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-3xl font-extrabold text-pink-700 mb-8 text-center tracking-tight">Historial de Ventas Diarias</h1>
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
        $meses_es = [
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
            '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
            '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        ];
    @endphp
    @if(isset($ventasPorMes) && count($ventasPorMes))
        @foreach($ventasPorMes as $mes => $ventasDiarias)
            @php
                $anio = substr($mes, 0, 4);
                $numMes = substr($mes, 5, 2);
                $nombreMes = $meses_es[$numMes] ?? $numMes;
            @endphp
            <div class="mb-10">
                <h2 class="text-xl font-bold text-pink-600 mb-4 mt-8">{{ $nombreMes . ' ' . $anio }}</h2>
                <div class="overflow-x-auto rounded-lg shadow bg-white dark:bg-zinc-900">
                    <table class="min-w-full divide-y divide-pink-200 dark:divide-zinc-700">
                        <thead class="bg-pink-100 dark:bg-pink-800">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-bold text-pink-700 dark:text-white uppercase">Fecha</th>
                                <th class="px-4 py-2 text-left text-xs font-bold text-pink-700 dark:text-white uppercase">Total del día</th>
                                <th class="px-4 py-2 text-left text-xs font-bold text-pink-700 dark:text-white uppercase">Pedidos</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-900 divide-y divide-pink-50 dark:divide-zinc-800">
                            @foreach($ventasDiarias as $venta)
                                <tr class="hover:bg-pink-50 dark:hover:bg-zinc-800 transition">
                                    <td class="px-4 py-3 text-pink-900 dark:text-pink-200 font-semibold">{{ $venta->fecha }}</td>
                                    <td class="px-4 py-3 text-green-700 dark:text-green-300 font-bold">Q{{ number_format($venta->total, 2) }}</td>
                                    <td class="px-4 py-3 text-zinc-700 dark:text-zinc-200 font-medium">{{ isset($venta->detalles) && is_countable($venta->detalles) ? count($venta->detalles) : 0 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex justify-center">
                    <div class="px-6 py-3 rounded-lg bg-pink-50 dark:bg-pink-900 border border-pink-200 dark:border-pink-700 text-lg font-bold text-pink-800 dark:text-pink-200 shadow">
                        Total vendido en el mes: <span class="text-green-700 dark:text-green-300">Q{{ number_format($ventasDiarias->sum('total'), 2) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center text-zinc-400">No hay ventas diarias registradas.</div>
    @endif
</div>
</x-layouts.app> 