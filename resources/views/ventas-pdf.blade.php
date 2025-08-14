<!DOCTYPE html>
<html>
<head>
    <title>Pedidos PDF</title>
     <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Pedidos</h1>
    <table>
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->cantidad }}</td>
                    <td>{{ $venta->nombre }}</td>
                    <td>Q {{ $venta->precio }}</td>
                    <td>{{ $venta->fecha ? \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
