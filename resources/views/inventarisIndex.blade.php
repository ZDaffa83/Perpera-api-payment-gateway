@extends('layouts.masterdash')

@section('title', 'Inventaris Gudang Bibit')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Inventaris Gudang Bibit HPT</h2>
            <p class="text-muted mb-0">Manajemen logistik internal stok fisik pakan ternak.</p>
        </div>
        <a href="{{ route('inventaris.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Catat Barang Masuk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">Nama Bibit</th>
                            <th>Stok Gudang</th>
                            <th>Lokasi Penyimpanan</th>
                            <th class="text-center" style="width: 200px;">Aksi Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventaris as $item)
                            <tr>
                                <td class="ps-4 fw-bold text-secondary">{{ $item->nama_bibit }}</td>
                                <td>
                                    <span class="badge {{ $item->stok_tersedia > 20 ? 'bg-info' : 'bg-danger' }} text-dark px-3 py-2">
                                        {{ $item->stok_tersedia }} Kantong
                                    </span>
                                </td>
                                <td><i class="fas fa-map-marker-alt text-muted me-1"></i> {{ $item->lokasi_gudang ?? 'Gudang Utama' }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('inventaris.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pencatatan stok barang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fas fa-warehouse fa-3x text-light mb-3 d-block"></i>
                                    Belum ada catatan barang masuk di gudang inventaris.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection