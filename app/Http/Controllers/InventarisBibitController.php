<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarisBibit;

class InventarisBibitController extends Controller
{
    public function index()
    {
        $inventaris = InventarisBibit::all();
        return view('inventarisIndex', compact('inventaris'));
    }
    public function create()
    {
        return view('inventarisCreate');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_bibit' => 'required',
            'stok_tersedia' => 'required|numeric',
        ]);

        InventarisBibit::create($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Stok baru berhasil dicatat!');
    }
    public function edit($id)
    {
        $item = InventarisBibit::findOrFail($id);
        return view('inventarisEdit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $item = InventarisBibit::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $item = InventarisBibit::findOrFail($id);
        $item->delete();

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil dihapus!');
    }
}