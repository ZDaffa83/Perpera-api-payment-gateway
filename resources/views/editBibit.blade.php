@extends('layouts.masterdash')
@section('title', 'Edit Bibit')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark p-3">
                    <h5 class="mb-0">Edit Data Bibit</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('bibit.update', $bibit->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Bibit</label>
                            <input type="text" name="nama" class="form-control" value="{{ $bibit->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" value="{{ $bibit->harga }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4" required>{{ $bibit->deskripsi }}</textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Update Data</button>
                            <a href="{{ route('bibit.index') }}" class="btn btn-light">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection