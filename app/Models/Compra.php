<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'cantidad',
        'nombre',
        'costo',
        'producto',
        'fecha',
    ];
}
