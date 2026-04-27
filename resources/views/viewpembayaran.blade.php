@extends('layouts.masterdash')
@section('title', 'Pembayaran Bibit - AgriSmart')
@section('content')
<div class="container py-5 text-center">
    <div class="card shadow border-0 mx-auto" style="max-width: 450px;">
        <div class="card-body p-4">
            <h4 class="mb-3">Detail Pembayaran</h4>
            <hr>
            <div class="text-start mb-4">
                <p><strong>Order ID:</strong> {{ $transaksi->order_id }}</p>
                <p><strong>Item:</strong> {{ $transaksi->jenis_bibit }}</p>
                <p><strong>Total:</strong> 
                    <span class="text-success fw-bold">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                </p>
            </div>
            
            <button class="btn btn-primary w-100 btn-lg" id="pay-button">Bayar Sekarang</button>
            <a href="{{ route('bibit.index') }}" class="btn btn-link w-100 mt-2 text-decoration-none text-muted">Batal</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- Script Midtrans Snap --}}
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    // Konfirmasi sebelum ke dashboard
                    if (confirm("Pembayaran Berhasil! Apakah Anda ingin kembali ke Dashboard untuk melihat riwayat?")) {
                        window.location.href = "{{ route('dashboard') }}";
                    } else {
                        // Jika klik 'Cancel' di konfirmasi, tetap arahkan ke index bibit atau tetap di sini
                        window.location.href = "{{ route('bibit.index') }}";
                    }
                },
                onPending: function(result){
                    alert("Menunggu Pembayaran. Silahkan selesaikan pembayaran Anda.");
                    // Tetap di halaman ini agar user bisa melihat instruksi
                },
                onError: function(result){
                    alert("Pembayaran Gagal! Silahkan coba lagi.");
                    window.location.reload(); // Refresh halaman untuk mencoba ulang
                },
                onClose: function(){
                    alert('Anda menutup jendela tanpa menyelesaikan pembayaran.');
                    // Kembali ke halaman index bibit jika batal
                    window.location.href = "{{ route('bibit.index') }}";
                }
            });
        });
    </script>
@endpush