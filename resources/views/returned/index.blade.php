@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Daftar Pengembalian</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Rental ID</th>
                    <th>Di kembalikan pada</th>
                    <th>Total Keterlambatan (Jika ada)</th>
                    <th>Total Kerusakan (Jika ada)</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($returned as $return)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $return->rental->car->car_id }}</td>
                        <td>{{ $return->returned_at }}</td>
                        <td>{{ $return->late_fee }}</td>
                        <td>{{ $return->damage_fee }}</td>
                        <td>{{ $return->condition_notes }}</td>
                        <td>
                            <a href="{{ route('returns.show', $return->id) }}" class="btn btn-info">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
