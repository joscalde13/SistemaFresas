<!DOCTYPE html>
<html>
<head>
    <title>Prueba PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #e91e63;
            text-align: center;
            font-size: 28px;
        }
        .caja {
            border: 3px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
            background-color: #f5f5f5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: 1px solid #333;
        }
        td {
            padding: 8px;
            border: 1px solid #333;
            text-align: center;
        }
        .precio {
            font-weight: bold;
            color: #FF5722;
        }
    </style>
</head>
<body>
    <h1>🍓 Mi Reporte de Prueba</h1>
    
    <div class="caja">
        <p><strong>¡Esto es una caja con bordes azules!</strong></p>
        <p>Todo lo que escribas aquí aparecerá EXACTAMENTE igual en el PDF.</p>
    </div>

    <p>Fecha de generación: {{ now()->format('d/m/Y H:i:s') }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Fresas con Crema</td>
                <td>5</td>
                <td class="precio">Q. 125.00</td>
            </tr>
            <tr>
                <td>Fresas con Chocolate</td>
                <td>3</td>
                <td class="precio">Q. 105.00</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 30px; font-style: italic;">
        ✅ Si ves esto en el PDF, significa que el HTML se convirtió perfectamente.
    </p>
</body>
</html>
