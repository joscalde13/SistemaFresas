<?php

namespace App\Http\Controllers;

use App\Models\VentaDiaria;
use App\Models\DetalleVentaDiaria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
} 