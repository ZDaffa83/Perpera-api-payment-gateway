@extends('layouts.masterdash')
@section('title', 'Daftar Bibit Pakan Ternak')
@section('content')
<div class="container">
    <h2 class="mb-4">Katalog Bibit Pakan Ternak</h2>
    <div class="row">
        @foreach($bibits as $b)
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5>{{ $b['nama'] }}</h5>
                    <p class="text-muted">{{ $b['deskripsi'] }}</p>
                    <h4 class="text-success">Rp {{ number_format($b['harga']) }}</h4>
                    <form action="{{ route('bibit.checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_bibit" value="{{ $b['id'] }}">
                        <input type="hidden" name="nama_bibit" value="{{ $b['nama'] }}">
                        <input type="hidden" name="harga" value="{{ $b['harga'] }}">
                        <button type="submit" class="btn btn-primary w-100">Beli Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection