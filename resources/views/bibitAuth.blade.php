@extends('layouts.masterdash')
@section('content')
<div class="container py-5 d-flex justify-content-center">
    <div class="card shadow-sm border-0" style="max-width: 400px; width: 100%;">
        <div class="card-body p-4 text-center">
            <h4>Verifikasi Admin</h4>
            <p class="text-muted small">Masukkan kode rahasia kita.</p>
            @if(session('error'))
                <div class="alert alert-danger py-2">{{ session('error') }}</div>
            @endif

            <form action="{{ route('bibit.verify') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="password" name="kode" class="form-control text-center" placeholder="••••••••" required autofocus>
                    <span class="text-muted" style="font-size: 0.75rem;">Yang admin admin saja xixixixxi</span>
                </div>
                <button type="submit" class="btn btn-dark w-100">Masuk ke Panel</button>
            </form>
            <a href="{{ route('bibit.index') }}" class="btn btn-link btn-sm mt-3 text-muted">Kembali ke Katalog</a>
        </div>
    </div>
</div>
@endsection