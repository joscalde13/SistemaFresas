<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Ventas por Día</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        tfoot { font-weight: bold; background-color: #e9e9e9; }
    </style>
</head>
<body>
    <h1>Reporte de Ventas por Día</h1>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Total Vendido</th>
                <th>Cantidad Vendida</th>
                <th>Total Invertido</th>
                <th>Ganancia</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datosPorDia as $dato)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($dato->fecha)->locale('es')->translatedFormat('l, d/m/Y') }}</td>
                    <td>Q. {{ number_format($dato->total_vendido, 2) }}</td>
                    <td>{{ $dato->cantidad_vendida }}</td>
                    <td>Q. {{ number_format($dato->total_invertido, 2) }}</td>
                    <td>Q. {{ number_format($dato->ganancia, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No hay datos disponibles.</td>
                </tr>
            @endforelse
        </tbody>
        @if ($datosPorDia->isNotEmpty())
            <tfoot>
                <tr>
                    <td style="text-align:right;">Totales:</td>
                    <td>Q. {{ number_format($datosPorDia->sum('total_vendido'), 2) }}</td>
                    <td>{{ $datosPorDia->sum('cantidad_vendida') }}</td>
                    <td>Q. {{ number_format($datosPorDia->sum('total_invertido'), 2) }}</td>
                    <td>Q. {{ number_format($datosPorDia->sum('ganancia'), 2) }}</td>
                </tr>
            </tfoot>
        @endif
    </table>
</body>
</html>
