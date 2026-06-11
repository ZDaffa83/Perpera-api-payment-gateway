@extends('layouts.masterdash')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white p-3">
                    <h5 class="mb-0">Tambah Barang Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('bibit.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Bibit</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Bibit Rumput Odot" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" placeholder="50000" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Jelaskan keunggulan bibit ini..." required></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">Simpan ke Katalog</button>
                            <a href="{{ route('bibit.index') }}" class="btn btn-light">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection