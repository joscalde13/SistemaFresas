<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'cantidad',
        'nombre',
        'direccion',
        'telefono',
        'tipo_fruta',
        'toppings',
        'untable',
        'medida',
        'precio',
        'vendido',
        'fecha',
        'horario',
    ];

    protected $casts = [
        'fecha' => 'date:Y-m-d',
        'tipo_fruta' => 'array',
        'toppings' => 'array',
    ];
}
