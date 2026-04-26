<?php

namespace App\Http\Controllers;

use App\Models\PerawatanHPT;
use Illuminate\Http\Request;

class PerawatanHPTController extends Controller
{
    public function index(Request $request)
    {
        // 1. Memulai Query
        $query = PerawatanHPT::query();

        // 2. Fitur Pencarian (Search)
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where('kegiatan', 'like', "%$q%")
                  ->orWhere('catatan', 'like', "%$q%");
            });
        }
        $data = $query->latest('tanggal')->paginate(10)->withQueryString();

        return view('perawatan', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        PerawatanHPT::create([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'catatan' => $request->catatan,
            // Jika checkbox tidak dicentang, default ke false
            'status' => $request->has('status') ? (bool) $request->status : false,
        ]);

        return redirect()->route('hpt.index')->with('success', 'Data berhasil ditambahkan.');
    }

        public function update(Request $request, $id)
        {
            $item = PerawatanHPT::findOrFail($id);

            // Jika request datang dari AJAX (Toggle Switch)
            if ($request->expectsJson()) {
                $item->update([
                    'status' => $request->status
                ]);
                return response()->json(['success' => true]);
            }

            // Jika request datang dari Form Modal
            $request->validate([
                'tanggal' => 'required|date',
                'kegiatan' => 'required|string|max:255',
                'catatan' => 'nullable|string',
            ]);

            $item->update([
                'tanggal' => $request->tanggal,
                'kegiatan' => $request->kegiatan,
                'catatan' => $request->catatan,
                'status' => $request->has('status') ? 1 : 0, // Handle checkbox form
            ]);

            return redirect()->route('hpt.index')->with('success', 'Data berhasil diperbarui');
        }

    public function destroy($id)
    {
        PerawatanHPT::findOrFail($id)->delete();
        return redirect()->route('hpt.index')->with('success', 'Data berhasil dihapus.');
    }
}