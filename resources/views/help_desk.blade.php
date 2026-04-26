@extends('layouts.masterdash')

@section('title', 'Help Desk')

@section('content')
<div class="container pb-5">
    {{-- Judul dan Deskripsi --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color: #1d433b;">FAQ</h1>
        <p class="text-muted mx-auto" style="max-width: 700px;">
            Temukan jawaban untuk pertanyaan umum tentang layanan, proses panen, dan dukungan sistem kami. 
            Jika Anda memiliki pertanyaan tambahan, jangan ragu untuk menghubungi tim teknis kami.
        </p>
    </div>

    {{-- Grid FAQ --}}
    <div class="row">
        {{-- Baris 1 --}}
        <div class="col-md-6 mb-4">
            <div class="d-flex align-items-start">
                <div class="faq-icon me-3">
                    <i class="fas fa-seedling"></i>
                </div>
                <div>
                    <h5 class="fw-bold" style="color: #1d433b;">Bagaimana cara menginput hasil panen?</h5>
                    <p class="text-muted small">Anda dapat masuk ke menu "Input Hasil Panen" di dashboard, pilih jenis rumput, masukkan tonase dalam angka desimal, dan simpan.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="d-flex align-items-start">
                <div class="faq-icon me-3">
                    <i class="fas fa-cloud-sun"></i>
                </div>
                <div>
                    <h5 class="fw-bold" style="color: #1d433b;">Dari mana data cuaca berasal?</h5>
                    <p class="text-muted small">Data cuaca disinkronkan secara real-time langsung dari API resmi BMKG khusus untuk wilayah Desa Limpakuwus setiap 30 menit.</p>
                </div>
            </div>
        </div>

        {{-- Baris 2 --}}
        <div class="col-md-6 mb-4">
            <div class="d-flex align-items-start">
                <div class="faq-icon me-3">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div>
                    <h5 class="fw-bold" style="color: #1d433b;">Mengapa grafik laporan tidak berubah?</h5>
                    <p class="text-muted small">Pastikan Anda sudah mengklik tombol simpan saat input data. Grafik akan otomatis terakumulasi berdasarkan total tonase yang masuk.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="d-flex align-items-start">
                <div class="faq-icon me-3">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div>
                    <h5 class="fw-bold" style="color: #1d433b;">Siapa yang bisa saya hubungi jika ada error?</h5>
                    <p class="text-muted small">Anda dapat menghubungi admin teknis melalui nomor WhatsApp yang tertera di bagian footer aplikasi ini untuk bantuan cepat.</p>
                </div>
            </div>
        </div>

        {{-- Baris 3 --}}
        <div class="col-md-6 mb-4">
            <div class="d-flex align-items-start">
                <div class="faq-icon me-3">
                    <i class="fas fa-history"></i>
                </div>
                <div>
                    <h5 class="fw-bold" style="color: #1d433b;">Apakah data tahun lalu bisa dilihat kembali?</h5>
                    <p class="text-muted small">Ya, sistem menyimpan histori permanen. Anda dapat menggunakan fitur "Laporan Tahunan" untuk melihat arsip panen periode sebelumnya.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="d-flex align-items-start">
                <div class="faq-icon me-3">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <h5 class="fw-bold" style="color: #1d433b;">Apakah data panen saya aman?</h5>
                    <p class="text-muted small">Tentu. Semua data enkripsi secara aman di server kami dan hanya dapat diakses oleh akun yang telah terdaftar secara resmi.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .faq-icon {
        background-color: #f0f7ef;
        color: #1d433b;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.2rem;
        flex-shrink: 0;
        border: 1px solid #d4e3d1;
    }
    h5 {
        font-size: 1.1rem;
        margin-bottom: 8px;
    }
    p.text-muted {
        line-height: 1.6;
    }
</style>
@endpush