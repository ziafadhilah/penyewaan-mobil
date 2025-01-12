@extends('layouts.main')
@section('title', 'Rental Mobil')

@section('content')
    <div class="container">
        <h1>Rental Mobil</h1>
        <a href="{{ route('rent.create') }}" class="btn btn-primary mb-3">Rental Mobil</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mobil</th>
                    <th>Harga Sewa</th>
                    <th>Dirental Pada</th>
                    <th>Berakhir Pada</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cars as $car)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $car->car->name }}</td>
                        <td>{{ $car->total_price }}</td>
                        <td>{{ $car->rented_at }}</td>
                        <td>{{ $car->due_date }}</td>
                        <td>{{ $car->status }}</td>
                        <td>
                            {{-- <a href="{{ route('rent.show', $car->id) }}" class="btn btn-info">Detail</a> --}}
                            <a href="{{ route('rent.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('rent.destroy', $car->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada mobil yang di sewa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
