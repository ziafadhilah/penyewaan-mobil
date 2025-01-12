@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Detail Penyewaan Mobil</h1>
        <div class="card">
            <div class="card-header">
                Informasi Penyewaan
            </div>
            <div class="card-body">
                <h5 class="card-title">Nama Penyewa: {{ $rental->nama_penyewa }}</h5>
                <p class="card-text">Mobil: {{ $rental->mobil }}</p>
                <p class="card-text">Tanggal Mulai: {{ $rental->tanggal_mulai }}</p>
                <p class="card-text">Tanggal Selesai: {{ $rental->tanggal_selesai }}</p>
                <p class="card-text">Harga: {{ $rental->harga }}</p>
                <a href="{{ route('rent.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
