@extends('layouts.masterdash')

@section('title', 'Catat Barang Gudang')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white p-3">
                    <h5 class="mb-0"><i class="fas fa-boxes"></i> Pencatatan Barang Masuk</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('inventaris.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Bibit HPT</label>
                            <input type="text" name="nama_bibit" class="form-control" placeholder="Contoh: Rumput Odot / Pakchong" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Stok Masuk (Jumlah Kantong/Kg)</label>
                            <input type="number" name="stok_tersedia" class="form-control" placeholder="Contoh: 150" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi Gudang / Sektor Rak (Opsional)</label>
                            <input type="text" name="lokasi_gudang" class="form-control" placeholder="Contoh: Gudang Barat, Rak A3">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">Simpan ke Gudang</button>
                            <a href="{{ route('inventaris.index') }}" class="btn btn-light">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection