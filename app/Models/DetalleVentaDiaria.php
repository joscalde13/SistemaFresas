<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentaDiaria extends Model
{
    use HasFactory;
    protected $fillable = [
        'venta_diaria_id',
        'producto',
        'cantidad',
        'precio',
        'subtotal',
    ];

    protected $table = 'detalle_ventas_diarias';

    public function ventaDiaria()
    {
        return $this->belongsTo(VentaDiaria::class, 'venta_diaria_id');
    }
} 