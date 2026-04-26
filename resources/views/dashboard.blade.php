{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.masterdash')

@section('title', 'Dashboard Petani')

@section('content')

    {{-- BARIS 1: Data Cuaca Utama --}}
<div class="row mb-4">
    <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
        <div class="agrisense-card card-weather-primary text-center">
            <small class="text-muted">Suhu</small>
            <div class="weather-value">{{ $currentWeather['suhu'] }}</div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
        <div class="agrisense-card card-weather-primary text-center">
            <small class="text-muted">Kelembaban</small>
            <div class="weather-value">{{ $currentWeather['kelembapan'] }}</div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
        <div class="agrisense-card card-weather-primary text-center">
            <small class="text-muted">Kecepatan Angin</small>
            <div class="weather-value">{{ $currentWeather['angin'] }}</div>
        </div>
    </div>
</div>

{{-- BARIS 2: Perkiraan Cuaca Harian --}}
<div class="row mb-4">
    <div class="col-12">
        <div class="agrisense-card card-daily-forecast d-flex flex-wrap justify-content-around text-center">
            @forelse($forecasts as $cast)
                <div class="daily-item flex-fill p-2">
                    {{ $cast['day'] }}<br>
                    <img src="{{ $cast['icon'] }}" style="width: 30px; height: 30px;" alt="icon"><br>
                    {{ $cast['temp'] }}
                </div>
            @empty
                <p>Data cuaca tidak tersedia</p>
            @endforelse
        </div>
    </div>
</div>

    <h4 class="mt-4 mb-3">Fitur Utama</h4>
    
    {{-- BARIS 3 & 4: Fitur Utama (6 Card Fitur) --}}
    <div class="row">
        {{-- Weekly Report --}}
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="agrisense-card card-feature text-center">
                <div class="title">Laporan Bulanan-Tahunan</div>
                <i class="fas fa-file-alt fa-2x mb-2"></i> 
                <a href="{{ route('laporan.index') }}" class="btn-buka">Buka</a>
            </div>
        </div>

        {{-- Input Hasil Panen --}}
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="agrisense-card card-feature text-center">
                <div class="title">Input Hasil Panen</div>
                <i class="fas fa-clipboard-list fa-2x mb-2"></i> 
                <a href="{{ route('panen.create') }}" class="btn-buka">Buka</a>
            </div>
        </div>

        {{-- Prediksi Hasil Panen --}}
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="agrisense-card card-feature text-center">
                <div class="title">Prediksi Hasil Panen</div>
                <i class="fas fa-clock fa-2x mb-2"></i> 
                <a href="{{ route('panen.prediksi') }}" class="btn-buka">Buka</a>
            </div>
        </div>

        {{-- Monitoring Cuaca --}}
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="agrisense-card card-feature text-center">
                <div class="title">Monitoring Cuaca</div>
                <i class="fas fa-cloud-sun fa-2x mb-2"></i> 
                <a href="{{ route('weather.monitoring') }}" class="btn-buka">Buka</a>
            </div>
        </div>

        {{-- Riwayat Tanam --}}
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="agrisense-card card-feature text-center">
                <div class="title">Riwayat Tanam</div>
                <i class="fas fa-seedling fa-2x mb-2"></i> 
                <a href="{{ route('riwayat.index') }}" class="btn-buka">Buka</a>
            </div>
        </div>
        
        {{-- Perawatan HPT --}}
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="agrisense-card card-feature text-center">
                <div class="title">Perawatan HPT</div>
                <i class="fas fa-hand-holding-water fa-2x mb-2"></i> 
                <a href="{{ route('hpt.index') }}" class="btn-buka">Buka</a>
            </div>
        </div>
        
        
    </div>
    
@endsection

@push('styles')
<style>
    .card-weather-primary, .card-feature {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .daily-item {
        min-width: 80px;
        font-size: 14px;
    }

    @media (max-width: 576px) {
        .weather-value {
            font-size: 20px;
        }
        .daily-item {
            font-size: 12px;
        }
        .card-feature .title {
            font-size: 14px;
        }
    }
</style>
@endpush