@php
    use Illuminate\Support\Facades\DB;
    use App\Models\Venta;
    use App\Models\Inventario;

    $totalVentas = Venta::sum('cantidad');
    $totalVentasPrecio = Venta::sum(DB::raw('cantidad * precio'));
    $totalInventarioCosto = Inventario::sum(DB::raw('cantidad * costo'));
    $totalGanancia = $totalVentasPrecio - $totalInventarioCosto;
    $recentOrders = Venta::orderBy('created_at', 'desc')->take(5)->get();
@endphp

<x-layouts.app>
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-3xl font-bold text-pink-700 mb-8 text-center">Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white dark:bg-zinc-900 rounded shadow p-6 text-center">
                <div class="text-xs text-zinc-500">Total de ventas (unidades)</div>
                <div class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $totalVentas }}</div>
            </div>
            <div class="bg-white dark:bg-zinc-900 rounded shadow p-6 text-center">
                <div class="text-xs text-zinc-500">Total vendido</div>
                <div class="text-2xl font-bold text-green-700 dark:text-green-300">Q{{ number_format($totalVentasPrecio, 2) }}</div>
            </div>
            <div class="bg-white dark:bg-zinc-900 rounded shadow p-6 text-center">
                <div class="text-xs text-zinc-500">Costo inventario</div>
                <div class="text-2xl font-bold text-orange-700 dark:text-orange-300">Q{{ number_format($totalInventarioCosto, 2) }}</div>
            </div>
            <div class="bg-white dark:bg-zinc-900 rounded shadow p-6 text-center">
                <div class="text-xs text-zinc-500">Ganancia estimada</div>
                <div class="text-2xl font-bold text-pink-700 dark:text-pink-300">Q{{ number_format($totalGanancia, 2) }}</div>
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
                            <td class="px-6 py-4 whitespace-nowrap text-pink-900 dark:text-pink-200 font-semibold align-top">{{ $order->created_at->format('Y-m-d H:i') }}</td>
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
            <h2 class="text-lg font-bold mb-4">Ventas mensuales</h2>
            <canvas id="graficaVentasDiarias" height="100"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/ventas-diarias/grafica')
                .then(response => response.json())
                .then(data => {
                    // Agrupar por mes y sumar total
                    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                    const ventasPorMes = {};
                    data.forEach(item => {
                        const [anio, mes] = item.fecha.split('-');
                        const key = mes; // solo el mes
                        if (!ventasPorMes[key]) ventasPorMes[key] = 0;
                        ventasPorMes[key] += Number(item.total);
                    });
                    const labels = Object.keys(ventasPorMes).map(mes => meses[parseInt(mes, 10) - 1]);
                    const valores = Object.values(ventasPorMes);
                    const ctx = document.getElementById('graficaVentasDiarias').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total vendido por mes',
                                data: valores,
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
                });
        });
    </script>
</x-layouts.app>

