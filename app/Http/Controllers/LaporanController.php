<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if (!session('kasir_logged_in')) {
            return redirect('/login');
        }

        $from = $request->input('from');
        $to = $request->input('to');
        $query = Penjualan::with('pelanggan');
        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }
        $penjualans = $query->orderBy('created_at', 'desc')->get();

        // Chart data: group by date
        $grouped = $penjualans->groupBy(function($item) {
            return optional($item->created_at)->format('Y-m-d');
        });
        $chartLabels = $grouped->keys()->sort()->values()->all();
        $chartData = [];
        foreach ($chartLabels as $tgl) {
            $chartData[] = $grouped[$tgl]->sum('grand_total');
        }

        return view('laporan.index', compact('penjualans', 'chartLabels', 'chartData'));
    }
}
