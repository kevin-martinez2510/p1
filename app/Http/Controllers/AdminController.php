<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Mostrar el dashboard del panel de administración.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Aquí se pueden cargar datos generales del sistema si es necesario,
        // por ejemplo: total de ventas, total de clientes, productos, etc.

        return view('admin.index');
    }
}
