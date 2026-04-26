@extends('layouts.masterdash')

@section('title', 'Input Hasil Panen')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="agrisense-card p-4 shadow-sm" style="background: #ffffff; border-radius: 15px; border-top: 5px solid #1d433b;">
                <div class="text-center mb-4">
                    <i class="fas fa-clipboard-list fa-3x mb-2" style="color: #1d433b;"></i>
                    <h4>Form Input Hasil Panen</h4>
                    <p class="text-muted small">Masukkan data tonase rumput yang baru saja dipanen.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('panen.store') }}" method="POST">
                    @csrf
                    
                    {{-- Pilihan Jenis Rumput --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Rumput</label>
                        <select name="jenis_rumput" class="form-select form-control-lg" required style="background-color: #f8faf7;">
                            <option value="" selected disabled>Pilih Jenis Rumput...</option>
                            <option value="Rumput Gajah">Rumput Gajah</option>
                            <option value="Rumput Raja">Rumput Raja</option>
                            <option value="Rumput Pakchong">Rumput Pakchong</option>
                            <option value="Rumput Odot">Rumput Odot</option>
                        </select>
                    </div>

                    {{-- Input Tonase --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tonase (Satuan Ton)</label>
                        <div class="input-group">
                            <input type="number" name="tonase" step="0.1" class="form-control form-control-lg" placeholder="Contoh: 12.5" required style="background-color: #f8faf7;">
                            <span class="input-group-text bg-success text-white">Ton</span>
                        </div>
                    </div>

                    {{-- Tanggal Panen --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tanggal Panen</label>
                        <input type="date" name="tanggal_panen" class="form-control form-control-lg" value="{{ date('Y-m-d') }}" required style="background-color: #f8faf7;">
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-lg text-white" style="background-color: #1d433b;">
                            <i class="fas fa-save me-2"></i> Simpan Data Panen
                        </button>
                        <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">
                            Lihat Laporan
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-control:focus, .form-select:focus {
        border-color: #1d433b;
        box-shadow: 0 0 0 0.25 cold-green;
    }
    .input-group-text {
        background-color: #1d433b !important;
        border: none;
    }
</style>
@endpush