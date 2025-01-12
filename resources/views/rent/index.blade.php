@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Rental Mobil</h1>
        <a href="{{ route('rent.create') }}" class="btn btn-primary mb-3">Tambah Data Mobil</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mobil</th>
                    <th>Harga Sewa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $car->name }}</td>
                        <td>{{ $car->rental_price }}</td>
                        <td>{{ $car->status }}</td>
                        <td>
                            <a href="{{ route('rent.show', $car->id) }}" class="btn btn-info">Detail</a>
                            <a href="{{ route('rent.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('rent.destroy', $car->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
