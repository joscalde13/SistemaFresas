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
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                    🗑️ Eliminar Todos los Registros
                </button>
            </form>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            {{-- Tarjeta 1: Total de Ventas --}}
            <div class="bg-pink-100 dark:bg-pink-900 border border-pink-300 dark:border-pink-700 shadow-lg rounded-2xl p-6 text-center">
                <h3 class="text-base font-semibold text-pink-700 dark:text-pink-200">Total de Ventas</h3>
                <p class="text-3xl font-bold text-pink-900 dark:text-pink-100 mt-2">{{ $totalVentas }}</p>
            </div>

            {{-- Tarjeta 2: Precio Total de Ventas --}}
            <div class="bg-pink-100 dark:bg-pink-900 border border-pink-300 dark:border-pink-700 shadow-lg rounded-2xl p-6 text-center">
                <h3 class="text-base font-semibold text-pink-700 dark:text-pink-200">Precio Total de Ventas</h3>
                <p class="text-3xl font-bold text-pink-900 dark:text-pink-100 mt-2">Q {{ number_format($totalVentasPrecio, 2) }}</p>
            </div>

            {{-- Tarjeta 3: Ganancia Total --}}
            <div class="bg-pink-100 dark:bg-pink-900 border border-pink-300 dark:border-pink-700 shadow-lg rounded-2xl p-6 text-center">
                <h3 class="text-base font-semibold text-pink-700 dark:text-pink-200">Ganancia Total</h3>
                <p class="text-3xl font-bold text-pink-900 dark:text-pink-100 mt-2">Q {{ number_format($totalGanancia, 2) }}</p>
            </div>

            {{-- Tarjeta 4: Costo Total de Inversión --}}
            <div class="bg-pink-100 dark:bg-pink-900 border border-pink-300 dark:border-pink-700 shadow-lg rounded-2xl p-6 text-center">
                <h3 class="text-base font-semibold text-pink-700 dark:text-pink-200">Costo de Inversión</h3>
                <p class="text-3xl font-bold text-pink-900 dark:text-pink-100 mt-2">Q {{ number_format($totalInventarioCosto, 2) }}</p>
            </div>
        </div>

        {{-- Órdenes Recientes --}}
        <div class="bg-white dark:bg-gray-900 border border-pink-300 dark:border-pink-700 rounded-2xl shadow-md p-6">
            <h3 class="text-lg font-semibold text-pink-700 dark:text-pink-300 mb-4">Órdenes Recientes</h3>
            <ul class="divide-y divide-pink-200 dark:divide-pink-800">
                @forelse ($recentOrders as $order)
                    <li class="py-3 flex justify-between text-pink-900 dark:text-pink-100">
                        <span>Cantidad  :  {{ $order->cantidad }}</span>
                        <span>{{ $order->nombre }}</span>
                        <span class="font-semibold">Q {{ number_format($order->precio, 2) }}</span>
                    </li>
                @empty
                    <li class="py-3 text-center text-pink-600 dark:text-pink-400">No hay órdenes recientes.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-layouts.app>
