<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PostmangApiController extends Controller
{
    // Method read
    public function index()
    {
        $weatherData = Cache::remember('weather_api_limpakuwus', 1800, function () {
            $response = Http::get("https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=33.02.13.2007");
            return $response->successful() ? $response->json() : null;
        });

        if (!$weatherData) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data dari BMKG'
            ], 500);
        }

        // postman get
        return response()->json([
            'status' => 'success',
            'lokasi' => $weatherData['lokasi']['desa'] ?? 'Limpakuwus',
            'data_cuaca' => $weatherData['data'][0]['cuaca'][0] ?? []
        ], 200);
    }

    // Postman post dummy sementara
    public function store(Request $request)
    {
        return response()->json([
        'status' => 'success',
        'message' => 'Data Berhasil Disimpan ke Sistem AgriSmart (Simulasi)',
        'data_yang_dikirim' => [
            'lokasi' => $request->lokasi,
            'suhu_input' => $request->suhu,
            'keterangan' => 'Data diterima via API Postman'
        ]
    ], 201);
    }
}
