@extends('layouts.masterdash')

@section('title', 'Monitoring Cuaca Detail')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4" style="color: #2d5a27;">Monitoring Data Cuaca - {{ $lokasi }}</h3>

    {{-- Grid Atas: 4 Card Utama --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="agrisense-card p-4 text-center h-100 shadow-sm">
                <small class="text-muted d-block mb-2">Suhu</small>
                <h2 class="fw-bold">{{ $current['t'] ?? '--' }}°C</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="agrisense-card p-4 text-center h-100 shadow-sm">
                <small class="text-muted d-block mb-2">Kelembapan</small>
                <h2 class="fw-bold">{{ $current['hu'] ?? '--' }}%</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="agrisense-card p-4 text-center h-100 shadow-sm">
                <small class="text-muted d-block mb-2">Peluang Hujan</small>
                <div class="d-flex align-items-center justify-content-center">
                    <h2 class="fw-bold me-2">{{ $current['pcp'] ?? '0' }}%</h2>
                    <img src="{{ str_replace(' ', '%20', $current['image'] ?? '') }}" width="40">
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="agrisense-card p-4 text-center h-100 shadow-sm">
                <small class="text-muted d-block mb-2">Kecepatan Angin</small>
                <h2 class="fw-bold">{{ $current['ws'] ?? '--' }} Knot</h2>
            </div>
        </div>
    </div>

    {{-- Baris Tengah: Kondisi Langit & Peringatan --}}
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="agrisense-card p-4 shadow-sm h-100">
                <h6 class="mb-3">Kondisi Langit</h6>
                <div class="d-flex align-items-center">
                    <img src="{{ str_replace(' ', '%20', $current['image'] ?? '') }}" width="60" class="me-3">
                    <div>
                        <p class="mb-0 fw-bold">{{ $current['weather_desc'] ?? 'N/A' }}</p>
                        <small class="text-muted">Kondisi saat ini di wilayah perkebunan.</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="agrisense-card p-4 shadow-sm h-100" style="border-left: 5px solid #ffc107;">
                <h6 class="mb-3">Peringatan / Saran</h6>
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning me-3"></i>
                    <p class="mb-0 small">
                        @if(($current['pcp'] ?? 0) > 50)
                            Peluang hujan tinggi. Pastikan sistem drainase lahan dalam kondisi baik.
                        @else
                            Cuaca mendukung untuk pemupukan dan penyemprotan rutin.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Hourly Weather --}}
    <h5 class="mb-3">Prakiraan Tiap 3 Jam</h5>
    <div class="agrisense-card p-3 shadow-sm overflow-auto">
        <div class="d-flex justify-content-between text-center" style="min-width: 800px;">
            @foreach($hourly as $h)
            <div class="p-3 border-radius-sm {{ $loop->first ? 'bg-success text-white' : '' }}" style="border-radius: 10px; min-width: 100px;">
                <small>{{ date('H:i', strtotime($h['local_datetime'])) }}</small><br>
                <img src="{{ str_replace(' ', '%20', $h['image'] ?? '') }}" width="35" class="my-2"><br>
                <span class="fw-bold">{{ $h['t'] }}°C</span><br>
                @if($loop->first) <small>Now</small> @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .agrisense-card {
        background: #f0f7ef; /* Hijau pucat sesuai screenshot */
        border: none;
        border-radius: 15px;
    }
    .bg-success {
        background-color: #2d5a27 !important; /* Hijau tua AgriSmart */
    }
</style>
@endpush