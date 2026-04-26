<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    public function index()
    {
        $weatherData = Cache::remember('weather_detail_limpakuwus', 1800, function () {
            // TKode wilayah Limpakuwus
            $response = Http::get("https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=33.02.13.2007");
            return $response->successful() ? $response->json() : null;
        });

        if (!$weatherData) {
            return back()->with('error', 'Gagal mengambil data cuaca.');
        }

        // Ambil data jam saat ini (Hourly)
        // BMKG menyediakan data per 3 jam
        $hourlyData = $weatherData['data'][0]['cuaca'][0] ?? [];
        
        // Data Cuaca Utama (Ambil indeks 0 sebagai kondisi sekarang)
        $current = $hourlyData[0] ?? [];

        return view('monitoring_cuaca', [
            'lokasi' => $weatherData['lokasi']['desa'] ?? 'Limpakuwus',
            'current' => $current,
            'hourly' => $hourlyData
        ]);
    }
}