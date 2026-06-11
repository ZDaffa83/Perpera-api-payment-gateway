<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiBibit;
use App\Models\Bibit;
use Midtrans\Config;
use Midtrans\Snap;

class BibitController extends Controller
{
    // Kode rahasia
    private $admin_code = "cihuycihuy";
    public function index()
    {
        $bibits = Bibit::all(); 
        return view('viewbibit', compact('bibits'));
    }
    public function enterCode()
    {
        return view('bibitAuth');
    }
    public function verifyCode(Request $request)
    {
        if ($request->kode === $this->admin_code) {
            session(['is_admin' => true]);
            return redirect()->route('bibit.index');
        }
        return back()->with('error', 'Kode salah! Akses ditolak.');
    }

    public function create()
    {
        if (!session('is_admin')) {
            return redirect()->route('bibit.auth');
        }
        return view('tambahBibit');
    }
    public function edit($id)
    {
        if (!session('is_admin')) return redirect()->route('bibit.auth');
        
        $bibit = Bibit::findOrFail($id);
        return view('editBibit', compact('bibit'));
    }
    public function update(Request $request, $id)
    {
        if (!session('is_admin')) return redirect()->route('bibit.auth');

        $bibit = Bibit::findOrFail($id);
        $bibit->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'description' => $request->deskripsi,
        ]);
        session()->forget('is_admin');
        return redirect()->route('bibit.index')->with('success', 'Data bibit berhasil diperbarui!');
    }
    public function destroy($id)
    {
        if (!session('is_admin')) return redirect()->route('bibit.auth');

        $bibit = Bibit::findOrFail($id);
        $bibit->delete();

        session()->forget('is_admin');
        return redirect()->route('bibit.index')->with('success', 'Bibit berhasil dihapus!');
    }
    public function store(Request $request)
    {
        Bibit::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        session()->forget('is_admin'); 
        return redirect()->route('bibit.index')->with('success', 'Bibit baru berhasil ditambahkan!');
    }

    // --- LOGIKA MIDTRANS ---
    public function checkout(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        Config::$is3ds = env('MIDTRANS_IS_3DS', true);

        $orderId = 'INV-' . rand();

        $transaksi = TransaksiBibit::create([
            'order_id' => $orderId,
            'nama_pembeli' => 'User AgriSmart',
            'jenis_bibit' => $request->nama_bibit,
            'jumlah' => 1,
            'total_harga' => $request->harga,
            'status' => 'pending',
        ]);

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

    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $transaksi = TransaksiBibit::where('order_id', $request->order_id)->first();
                if($transaksi) {
                    $transaksi->update(['status' => 'success']);
                }
            }
        }
    }
}