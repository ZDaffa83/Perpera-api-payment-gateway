<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiBibit;
use Midtrans\Config;
use Midtrans\Snap;

class BibitController extends Controller
{
    public function index()
    {
        $bibits = [
            ['id' => 1, 'nama' => 'Bibit Rumput Odot', 'harga' => 50000, 'deskripsi' => 'Pakan ternak bergizi tinggi.'],
            ['id' => 2, 'nama' => 'Bibit Indigofera', 'harga' => 75000, 'deskripsi' => 'Kandungan protein sangat baik.'],
        ];
        return view('viewbibit', compact('bibits'));
    }

    public function checkout(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        Config::$is3ds = env('MIDTRANS_IS_3DS', true);
        $orderId = 'INV-' . rand();
        //Simpan ke Database (Status Pending)
        $transaksi = TransaksiBibit::create([
            'order_id' => $orderId,
            'nama_pembeli' => 'User AgriSmart',
            'jenis_bibit' => $request->nama_bibit,
            'jumlah' => 1,
            'total_harga' => $request->harga,
            'status' => 'pending',
        ]);
        //Detail pembelian
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->harga,
            ],
            'customer_details' => [
                'first_name' => 'User',
                'last_name' => 'AgriSmart',
                'email' => 'user@example.com',
            ],
        ];
        $snapToken = Snap::getSnapToken($params);
        $transaksi->update(['snap_token' => $snapToken]);

        return view('viewpembayaran', compact('snapToken', 'transaksi'));
    }
    // Callback Midtrans
    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $transaksi = TransaksiBibit::where('order_id', $request->order_id)->first();
                $transaksi->update(['status' => 'success']);
            }
        }
    }
}
