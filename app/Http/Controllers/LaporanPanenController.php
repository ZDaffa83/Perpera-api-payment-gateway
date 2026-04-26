<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPanenController extends Controller
{
    public function index()
    {
        // Ambil data untuk Tabel
        $laporan = Panen::select('jenis_rumput', DB::raw('SUM(tonase) as total_tonase'))
            ->groupBy('jenis_rumput')
            ->get();
        $chartLabels = $laporan->pluck('jenis_rumput');
        $chartData = $laporan->pluck('total_tonase');

        return view('laporan_panen', compact('laporan', 'chartLabels', 'chartData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_rumput' => 'required',
            'tonase' => 'required|numeric',
            'tanggal_panen' => 'required|date',
        ]);

        Panen::create($request->all());
        return back()->with('success', 'Data panen berhasil disimpan!');
    }
}
