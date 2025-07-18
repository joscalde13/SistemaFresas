@php
    use Illuminate\Support\Facades\DB;
    use App\Models\Venta;
    use App\Models\Inventario;
    use App\Models\VentaDiaria;
    use Carbon\Carbon;

    $totalVentas = Venta::sum('cantidad');
    $totalVentasPrecio = Venta::sum(DB::raw('cantidad * precio'));
    $totalInventarioCosto = Inventario::sum(DB::raw('cantidad * costo'));
    $totalGanancia = $totalVentasPrecio - $totalInventarioCosto;
    $recentOrders = Venta::orderBy('created_at', 'desc')->take(5)->get();
    $ultimos30 = VentaDiaria::where('fecha', '>=', Carbon::now()->subDays(30)->toDateString())->get();
    $promedioVentaDiaria = $ultimos30->count() ? round($ultimos30->sum('total') / $ultimos30->count(), 2) : 0;
    $mejorDia = VentaDiaria::orderByDesc('total')->first();
    $anioActual = Carbon::now()->format('Y');
    $totalAnual = VentaDiaria::where('fecha', 'like', "$anioActual%") ->sum('total');
@endphp

<x-layouts.app>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <h1 class="text-4xl font-extrabold text-pink-700 dark:text-pink-300 mb-12 text-center tracking-tight">Panel de Control</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Card: Total Ventas -->
            <div class="group bg-gradient-to-br from-pink-400 via-pink-500 to-pink-600 dark:from-pink-700 dark:via-pink-800 dark:to-pink-900 rounded-3xl shadow-xl p-8 flex flex-col items-center transition-transform duration-200 hover:scale-105">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-white opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h2l1 2h13l1-2h2M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                </div>
                <div class="text-lg text-white/80 font-semibold mb-1">Total de ventas (unidades)</div>
                <div class="text-3xl font-extrabold text-white">{{ $totalVentas }}</div>
            </div>
            <!-- Card: Total Vendido -->
            <div class="group bg-gradient-to-br from-pink-400 via-pink-500 to-pink-600 dark:from-pink-700 dark:via-pink-800 dark:to-pink-900 rounded-3xl shadow-xl p-8 flex flex-col items-center transition-transform duration-200 hover:scale-105">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-white opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 10v4m8-8a8 8 0 11-16 0 8 8 0 0116 0z"/></svg>
                </div>
                <div class="text-lg text-white/80 font-semibold mb-1">Total vendido</div>
                <div class="text-3xl font-extrabold text-white">Q{{ number_format($totalVentasPrecio, 2) }}</div>
            </div>
            <!-- Card: Costo Inventario -->
            <div class="group bg-gradient-to-br from-pink-400 via-pink-500 to-pink-600 dark:from-pink-700 dark:via-pink-800 dark:to-pink-900 rounded-3xl shadow-xl p-8 flex flex-col items-center transition-transform duration-200 hover:scale-105">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-white opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 17v-2a4 4 0 014-4h10a4 4 0 014 4v2"/></svg>
                </div>
                <div class="text-lg text-white/80 font-semibold mb-1">Costo inventario</div>
                <div class="text-3xl font-extrabold text-white">Q{{ number_format($totalInventarioCosto, 2) }}</div>
            </div>
            <!-- Card: Ganancia -->
            <div class="group bg-gradient-to-br from-pink-400 via-pink-500 to-pink-600 dark:from-pink-700 dark:via-pink-800 dark:to-pink-900 rounded-3xl shadow-xl p-8 flex flex-col items-center transition-transform duration-200 hover:scale-105">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-white opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 0V4m0 12v4"/></svg>
                </div>
                <div class="text-lg text-white/80 font-semibold mb-1">Ganancia estimada</div>
                <div class="text-3xl font-extrabold text-white">Q{{ number_format($totalGanancia, 2) }}</div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Card: Promedio venta diaria -->
            <div class="group bg-gradient-to-br from-pink-200 via-pink-300 to-pink-400 dark:from-pink-800 dark:via-pink-900 dark:to-pink-950 rounded-3xl shadow-xl p-8 flex flex-col items-center transition-transform duration-200 hover:scale-105">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-pink-700 dark:text-pink-200 opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18"/></svg>
                </div>
                <div class="text-lg text-pink-700 dark:text-pink-200 font-semibold mb-1">Promedio venta diaria (30 días)</div>
                <div class="text-3xl font-extrabold text-pink-700 dark:text-pink-200">Q{{ number_format($promedioVentaDiaria, 2) }}</div>
            </div>
            <!-- Card: Mejor día de ventas -->
            <div class="group bg-gradient-to-br from-pink-200 via-pink-300 to-pink-400 dark:from-pink-800 dark:via-pink-900 dark:to-pink-950 rounded-3xl shadow-xl p-8 flex flex-col items-center transition-transform duration-200 hover:scale-105">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-pink-700 dark:text-pink-200 opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 0V4m0 12v4"/></svg>
                </div>
                <div class="text-lg text-pink-700 dark:text-pink-200 font-semibold mb-1">Mejor día de ventas</div>
                <div class="text-lg font-bold text-pink-700 dark:text-pink-200">
                    {{ $mejorDia ? \Carbon\Carbon::parse($mejorDia->fecha)->format('d-m-Y') : '-' }}<br>
                    <span class="text-2xl font-extrabold">Q{{ $mejorDia ? number_format($mejorDia->total, 2) : '0.00' }}</span>
                </div>
            </div>
            <!-- Card: Total vendido en el año -->
            <div class="group bg-gradient-to-br from-pink-200 via-pink-300 to-pink-400 dark:from-pink-800 dark:via-pink-900 dark:to-pink-950 rounded-3xl shadow-xl p-8 flex flex-col items-center transition-transform duration-200 hover:scale-105">
                <div class="mb-4">
                    <svg class="w-12 h-12 text-pink-700 dark:text-pink-200 opacity-80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 10v4m8-8a8 8 0 11-16 0 8 8 0 0116 0z"/></svg>
                </div>
                <div class="text-lg text-pink-700 dark:text-pink-200 font-semibold mb-1">Total vendido en el año</div>
                <div class="text-3xl font-extrabold text-pink-700 dark:text-pink-200">Q{{ number_format($totalAnual, 2) }}</div>
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded shadow p-6 mt-8">
            <h2 class="text-lg font-bold mb-4">Últimas 5 ventas</h2>
            <table class="min-w-full divide-y divide-pink-100 dark:divide-zinc-800">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Producto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Cantidad</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-pink-100 dark:divide-zinc-800">
                    @forelse($recentOrders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-pink-900 dark:text-pink-200 font-semibold align-top">{{ $order->created_at->format('d-m-Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->cantidad }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Q{{ number_format($order->precio, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-bold text-green-700 dark:text-green-300">Q{{ number_format($order->cantidad * $order->precio, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-zinc-400">No hay ventas recientes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded shadow p-6 mt-8">
            <h2 class="text-lg font-bold mb-4">Gráfica de Ventas Diarias</h2>
            <canvas id="graficaVentasDiarias" height="100"></canvas>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded shadow p-6 mt-8">
            <h2 class="text-lg font-bold mb-4">Gráfica de Ventas por Mes</h2>
            <canvas id="graficaVentasPorMes" height="100"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/ventas-diarias/grafica')
                .then(response => response.json())
                .then(data => {
                    // Gráfica de ventas diarias
                    const ctxDiaria = document.getElementById('graficaVentasDiarias').getContext('2d');
                    new Chart(ctxDiaria, {
                        type: 'bar',
                        data: {
                            labels: data.map(item => item.fecha),
                            datasets: [{
                                label: 'Total vendido por día ',
                                data: data.map(item => item.total),
                                backgroundColor: 'rgba(236, 72, 153, 0.5)',
                                borderColor: 'rgba(236, 72, 153, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    // Gráfica de ventas por mes
                    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                    const ventasPorMes = {};
                    data.forEach(item => {
                        const [anio, mes] = item.fecha.split('-');
                        const key = mes; // solo el mes
                        if (!ventasPorMes[key]) ventasPorMes[key] = 0;
                        ventasPorMes[key] += Number(item.total);
                    });
                    // Obtener los meses presentes en los datos y ordenarlos cronológicamente según aparición
                    const mesesPresentes = Object.keys(ventasPorMes).sort((a, b) => parseInt(a) - parseInt(b));
                    const labelsMes = mesesPresentes.map(mes => meses[parseInt(mes, 10) - 1]);
                    const valoresMes = mesesPresentes.map(mes => ventasPorMes[mes]);
                    const ctxMes = document.getElementById('graficaVentasPorMes').getContext('2d');
                    new Chart(ctxMes, {
                        type: 'bar',
                        data: {
                            labels: labelsMes,
                            datasets: [{
                                label: 'Total vendido por mes',
                                data: valoresMes,
                                backgroundColor: 'rgba(34, 197, 94, 0.5)',
                                borderColor: 'rgba(34, 197, 94, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>
</x-layouts.app>



