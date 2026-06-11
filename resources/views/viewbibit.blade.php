@extends('layouts.masterdash')
@section('title', 'Daftar Bibit Pakan Ternak')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Katalog Bibit Pakan Ternak</h2>
            <p class="mb-0">Berikut pilihan bibit berkualitas 
                <a href="{{ route('bibit.auth') }}" class="text-decoration-none text-muted">dari kami</a>
            </p>
        </div>
        @if(session('is_admin'))
            <a href="{{ route('bibit.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Bibit Baru
            </a>
        @endif
    </div>
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($bibits as $b)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold">{{ $b->nama }}</h5>
                        <p class="text-muted small flex-grow-1">{{ $b->deskripsi }}</p>
                        <h4 class="text-success mb-3">Rp {{ number_format($b->harga) }}</h4>
                        
                        {{-- Form Pembelian (User Biasa) --}}
                        <form action="{{ route('bibit.checkout') }}" method="POST" class="mb-2">
                            @csrf
                            <input type="hidden" name="nama_bibit" value="{{ $b->nama }}">
                            <input type="hidden" name="harga" value="{{ $b->harga }}">
                            <button type="submit" class="btn btn-primary w-100">Beli Sekarang</button>
                        </form>


                        @if(session('is_admin'))
                            <div class="btn-group w-100 mt-2">
                                <a href="{{ route('bibit.edit', $b->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('bibit.destroy', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus bibit ini dari katalog?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="bg-white p-5 rounded shadow-sm">
                    <i class="fas fa-seedling fa-3x text-light mb-3"></i>
                    <p class="text-muted">
                        Belum ada bibit yang tersedia. Silakan hubungi 
                        <a href="{{ route('bibit.auth') }}" class="text-decoration-none text-muted">admin</a>
                    </p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection