<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatTanam;

class RiwayatTanamController extends Controller
{
    public function index()
    {
        $data = RiwayatTanam::paginate(10);
        return view('riwayat_tanam', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan_perawatan' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        RiwayatTanam::create($request->all());
        return redirect()->route('riwayat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        $item = RiwayatTanam::findOrFail($id);
        return view('riwayat_tanam_detail', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan_perawatan' => 'required|string|max:255',
            'catatan' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $item = RiwayatTanam::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('riwayat.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        RiwayatTanam::findOrFail($id)->delete();
        return redirect()->route('riwayat.index')->with('success', 'Data berhasil dihapus.');
    }
}