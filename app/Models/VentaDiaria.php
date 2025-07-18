<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetalleVentaDiaria;

class VentaDiaria extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'total'];
    protected $table = 'ventas_diarias';

    public function detalles()
    {
        return $this->hasMany(DetalleVentaDiaria::class, 'venta_diaria_id');
    }
} 