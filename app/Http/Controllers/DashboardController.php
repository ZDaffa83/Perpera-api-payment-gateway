<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Gunakan Cache selama 30 menit agar tidak terus-menerus menembak API BMKG
        $weatherData = Cache::remember('weather_limpakuwus', 1800, function () {
           $response = Http::get("https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=33.02.13.2007");
            return $response->successful() ? $response->json() : null;
        });

        // Inisialisasi data default jika API gagal
        $currentWeather = [
            'suhu' => '--',
            'kelembapan' => '--',
            'angin' => '--',
        ];
        $forecasts = [];

        if ($weatherData && isset($weatherData['data'][0]['cuaca'])) {
            // 1. Ambil data cuaca saat ini (indeks jam pertama)
            $now = $weatherData['data'][0]['cuaca'][0][0]; 
            $currentWeather = [
                'suhu'       => ($now['t'] ?? '0') . '°C',
                'kelembapan' => ($now['hu'] ?? '0') . '%',
                'angin'      => ($now['ws'] ?? '0') . ' Km/h',
            ];

            // 2. Ambil ringkasan harian (mengambil data jam 12:00 setiap harinya sebagai perwakilan)
            foreach ($weatherData['data'][0]['cuaca'] as $dayForecast) {
                $midDay = $dayForecast[2] ?? $dayForecast[0]; 
                
                // Mendapatkan nama hari singkat (Mon, Tue, dsb)
                $dayName = date('D', strtotime($midDay['local_datetime']));

                $forecasts[] = [
                    'day'   => $dayName,
                    'icon'  => str_replace(' ', '%20', $midDay['image'] ?? ''),
                    'temp'  => ($midDay['t'] ?? '0') . '°C'
                ];
            }
        }

        return view('dashboard', compact('currentWeather', 'forecasts'));
    }
}