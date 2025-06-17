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
        'toppings',
        'untable',
        'medida',
        'precio',
        'vendido',
    ];
}
