@extends('layouts.masterdash')

@section('title', 'Prediksi Hasil Panen')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4" style="color: #1d433b;">Analisis Prediksi Panen</h3>

    <div class="row mb-4">
        {{-- Kartu Prediksi Total --}}
        <div class="col-lg-4 mb-4">
            <div class="agrisense-card p-4 h-100" style="background: #f0f7ef; border: 1px solid #7a9d75;">
                <h6 class="text-muted">Prediksi Total Panen</h6>
                <div class="display-4 fw-bold mt-3" style="color: #1d433b;">42.5 <small class="h4">Ton</small></div>
                <p class="text-success mt-2"><i class="fas fa-arrow-up"></i> +12% dari periode lalu</p>
                <hr>
                <small class="text-muted italic">*Berdasarkan kondisi cuaca Limpakuwus & histori pemupukan.</small>
            </div>
        </div>

        {{-- Rekomendasi Perawatan --}}
        <div class="col-lg-3 mb-4">
            <div class="agrisense-card p-4 h-100 bg-dark-green text-white">
                <h6 class="mb-3">Rekomendasi Perawatan</h6>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex">
                        <i class="fas fa-check-circle me-2 text-warning"></i> 
                        <span>Pemberian pupuk NPK (Minggu ke-4)</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-check-circle me-2 text-warning"></i> 
                        <span>Pembersihan gulma sektor B</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-check-circle me-2 text-warning"></i> 
                        <span>Cek sistem irigasi hulu</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Grafik Interval Panen --}}
        <div class="col-lg-5 mb-4">
            <div class="agrisense-card p-4 h-100 bg-dark-green text-white">
                <h6 class="mb-3">Interval Panen (Tonase)</h6>
                <canvas id="intervalChart" style="max-height: 200px;"></canvas>
            </div>
        </div>
    </div>

    {{-- Timeline Progress Panen --}}
    <div class="row">
        <div class="col-12">
            <div class="agrisense-card p-4 bg-dark-green text-white">
                <div class="d-flex justify-content-between mb-2">
                    <h6>Timeline Menuju Panen Raya</h6>
                    <span class="badge bg-warning text-dark">16 Hari Lagi</span>
                </div>
                <div class="progress" style="height: 30px; border-radius: 15px; background: rgba(255,255,255,0.2);">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                         role="progressbar" 
                         style="width: 75%; background-color: #7a9d75;" 
                         aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                         75% Masa Pertumbuhan
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2 small">
                    <span>Tanam: 12 Okt 2025</span>
                    <span>Estimasi Panen: 08 Jan 2026</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-dark-green { background-color: #1d433b !important; border-radius: 15px; }
    .agrisense-card { border-radius: 15px; border: none; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('intervalChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Apr', 'Jul', 'Okt'],
            datasets: [{
                label: 'Hasil (Ton)',
                data: [25, 38, 32, 45],
                backgroundColor: ['#f0f7ef', '#7a9d75', '#d4e3d1', '#ffc107'],
                borderRadius: 5
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { ticks: { color: 'white' }, grid: { color: 'rgba(255,255,255,0.1)' } },
                x: { ticks: { color: 'white' }, grid: { display: false } }
            }
        }
    });
</script>
@endpush