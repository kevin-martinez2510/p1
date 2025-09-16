<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminVentaController extends Controller
{
    public function index(Request $request)
    {
        $hoy = Carbon::today();
        $inicioSemana = $hoy->copy()->startOfWeek();
        $finSemana = $hoy->copy()->endOfWeek();

        $inicioSemanaPasada = $inicioSemana->copy()->subWeek();
        $finSemanaPasada = $finSemana->copy()->subWeek();

        $ventas = Venta::with('cliente')
            ->whereBetween('fecha', [$inicioSemana->copy()->startOfDay(), $finSemana->copy()->endOfDay()])
            ->orderBy('fecha', 'desc')
            ->get();

        $totalSemana = (float) $ventas->sum('total');

        $ventasSemanaPasada = Venta::whereBetween('fecha', [$inicioSemanaPasada->copy()->startOfDay(), $finSemanaPasada->copy()->endOfDay()])->get();
        $totalSemanaPasada = (float) $ventasSemanaPasada->sum('total');

        if ($totalSemanaPasada == 0) {
            $diferencia = $totalSemana == 0 ? 0.0 : 100.0;
        } else {
            $diferencia = (($totalSemana - $totalSemanaPasada) / $totalSemanaPasada) * 100;
        }
        $diferencia = round($diferencia, 2);

        // Datos para la gráfica diaria
        $days = [];
        $labels = [];
        $data = [];
        $cursor = $inicioSemana->copy();
        while ($cursor->lte($finSemana)) {
            $days[] = $cursor->format('Y-m-d');
            $labels[] = $cursor->format('D d');
            $cursor->addDay();
        }

        $sums = Venta::select(DB::raw('DATE(fecha) as dia'), DB::raw('COALESCE(SUM(total),0) as total'))
            ->whereBetween('fecha', [$inicioSemana->copy()->startOfDay(), $finSemana->copy()->endOfDay()])
            ->groupBy('dia')
            ->pluck('total','dia')
            ->toArray();

        foreach ($days as $day) {
            $data[] = isset($sums[$day]) ? (float)$sums[$day] : 0;
        }

        return view('admin.ventas.dashboard', compact(
            'ventas',
            'totalSemana',
            'totalSemanaPasada',
            'diferencia',
            'labels',
            'data'
        ));
    }

    // Detalle venta (para modal AJAX)
    public function detalle($id)
    {
        $venta = Venta::with(['cliente', 'items.producto'])->findOrFail($id);

        // Si la petición es AJAX, devuelve solo el partial
        if(request()->ajax()){
            return view('admin.ventas.partials.detalle', compact('venta'))->render();
        }

        // Si no es AJAX, redirige a dashboard
        return redirect()->route('admin.ventas.index');
    }
}
