@extends('layouts.main')
@section('title', 'Daftar Mobil')
@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Daftar Mobil awokkwaawkwakwkwwa</h1>
        <form method="GET" action="{{ route('cars.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Cari berdasarkan nama"
                        value="{{ old('name', request('name')) }}">
                </div>
                <div class="col-md-4">
                    <select name="category_id" class="form-select">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', request('category_id')) == $category->id ? 'selected' : '' }}>
                                {{ $category->brand }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">Pilih Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Disewa</option>
                        <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Perawatan
                        </option>
                    </select>
                </div>
                <div class="col-md-4 mt-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('cars.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
        <div class="mb-3">
            <a href="{{ route('cars.create') }}" class="btn btn-success">Tambah Mobil</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Merek</th>
                    <th>Nomor Plat</th>
                    <th>Kategori</th>
                    <th>Harga per Hari</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cars as $car)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $car->name }}</td>
                        <td>{{ $car->category->brand }}</td>
                        <td>{{ $car->licence_plate }}</td>
                        <td>{{ $car->category->model ?? '-' }}</td>
                        <td>Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</td>
                        <td>
                            @if ($car->status === 'available')
                                <span class="badge bg-success">Tersedia</span>
                            @elseif($car->status === 'rented')
                                <span class="badge bg-warning">Disewa</span>
                            @else
                                <span class="badge bg-danger">Perawatan</span>
                            @endif
                        </td>
                        <td>
                            {{-- <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data mobil.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
