@extends('layouts.masterdash')

@section('title', 'Edit Stok Gudang')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark p-3">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> Perbarui Data Inventaris</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('inventaris.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Bibit HPT</label>
                            <input type="text" name="nama_bibit" class="form-control" value="{{ $item->nama_bibit }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Stok Fisik Saat Ini</label>
                            <input type="number" name="stok_tersedia" class="form-control" value="{{ $item->stok_tersedia }}" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi Penyimpanan</label>
                            <input type="text" name="lokasi_gudang" class="form-control" value="{{ $item->lokasi_gudang }}">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                            <a href="{{ route('inventaris.index') }}" class="btn btn-light">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection