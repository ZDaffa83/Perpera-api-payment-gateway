@extends('layouts.masterdash')
@section('title', 'Laporan Hasil Panen')
@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Sisi Kiri: Tabel dan Cuaca --}}
        <div class="col-md-7">
            <h2 class="mb-4">Januari - Februari</h2>
            
            <div class="agrisense-card p-0 mb-4" style="background: #eef5ed; border: 1px solid #7a9d75;">
                <table class="table mb-0">
                    <thead style="background: #d4e3d1;">
                        <tr>
                            <th>Jenis Rumput</th>
                            <th>Tonase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $data)
                        <tr>
                            <td>{{ $data->jenis_rumput }}</td>
                            <td>{{ $data->total_tonase }} Ton</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row text-white text-center">
                <div class="col-4"><div class="p-3 bg-dark-green rounded">Curah Hujan<br>85 mm</div></div>
                <div class="col-4"><div class="p-3 bg-dark-green rounded">Suhu<br>29°C</div></div>
                <div class="col-4"><div class="p-3 bg-dark-green rounded">Kelembapan<br>78%</div></div>
            </div>
        </div>

        {{-- Sisi Kanan: Chart --}}
        <div class="col-md-5">
            <div class="agrisense-card h-100 p-4" style="background: #1d433b; border-radius: 20px;">
                <canvas id="panenChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-dark-green { background-color: #1d433b; }
    .table td, .table th { border-color: #7a9d75; padding: 15px; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('panenChart');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                data: {!! json_encode($chartData) !!},
                backgroundColor: ['#ffc107', '#d4e3d1', '#f0f7ef', '#7a9d75']
            }]
        },
        options: {
            plugins: { legend: { labels: { color: 'white' } } }
        }
    });
</script>
@endpush