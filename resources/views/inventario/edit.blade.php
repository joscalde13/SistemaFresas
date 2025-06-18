<div class="container">
    <h1>Editar Venta</h1>

    <form method="POST" action="{{ route('ventas.update', $venta->id) }}">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre', $venta->nombre) }}" required>

        <label>Dirección:</label>
        <input type="text" name="direccion" value="{{ old('direccion', $venta->direccion) }}" required>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="{{ old('telefono', $venta->telefono) }}" required>

        <label>Medida:</label>
        <select name="medida" id="venta_medida" required>
            <option value="12 Onzas" {{ old('medida', $venta->medida) == '12 Onzas' ? 'selected' : '' }}>12 Onzas</option>
            <option value="16 Onzas" {{ old('medida', $venta->medida) == '16 Onzas' ? 'selected' : '' }}>16 Onzas</option>
        </select>

        <label>Toppings:</label>
        <select name="toppings[]" id="venta_toppings" multiple required>
            @php
                $toppingsSeleccionados = is_array($venta->toppings) ? $venta->toppings : json_decode($venta->toppings, true);
            @endphp
            @foreach (['Granola', 'Oreo', 'Fresa', 'Banano'] as $topping)
                <option value="{{ $topping }}" {{ in_array($topping, old('toppings', $toppingsSeleccionados)) ? 'selected' : '' }}>
                    {{ $topping }}
                </option>
            @endforeach
        </select>

        <label>Untable:</label>
        <input type="text" name="untable" value="{{ old('untable', $venta->untable) }}">

        <label>Precio:</label>
        <input type="number" step="0.01" name="precio" value="{{ old('precio', $venta->precio) }}" required>

        <label>Cantidad:</label>
        <input type="number" name="cantidad" value="{{ old('cantidad', $venta->cantidad) }}" required>

        <label>Horario (opcional):</label>
        <input type="text" name="horario" value="{{ old('horario', $venta->horario) }}">

        <label>Fecha (opcional):</label>
        <input type="date" name="fecha" value="{{ old('fecha', \Carbon\Carbon::parse($venta->fecha)->format('Y-m-d')) }}">

        <button type="submit">Actualizar</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const medidaSelect = document.getElementById('venta_medida');
    const toppingsSelect = document.getElementById('venta_toppings');

    function actualizarMaxToppings() {
        let max = medidaSelect.value === '12 Onzas' ? 2 : 3;
        const opciones = toppingsSelect.options;

        // Deshabilitar todos primero
        for (let i = 0; i < opciones.length; i++) {
            opciones[i].disabled = false;
        }

        // Si ya hay más de max seleccionados, deshabilitar los demás
        if (toppingsSelect.selectedOptions.length >= max) {
            for (let i = 0; i < opciones.length; i++) {
                if (!opciones[i].selected) {
                    opciones[i].disabled = true;
                }
            }
        }
    }

    toppingsSelect.addEventListener('change', actualizarMaxToppings);
    medidaSelect.addEventListener('change', function () {
        const selectedOptions = [...toppingsSelect.selectedOptions];
        toppingsSelect.selectedIndex = -1; // deselect all
        selectedOptions.forEach(option => option.selected = true); // keep only allowed ones
        actualizarMaxToppings();
    });

    actualizarMaxToppings();
});
</script>
