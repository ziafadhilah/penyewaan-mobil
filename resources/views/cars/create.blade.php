@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Mobil Baru</h1>

        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="mb-3 col-lg-6">
                <label for="name" class="form-label">Nama Mobil</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->brand . ' - ' . $category->model }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price_per_day" class="form-label">Harga Sewa (per Hari)</label>
                <div class="input-group">
                    <span class="input-group-text" id="price_per_day">Rp.</span>
                    <input type="number" id="price_per_day" name="price_per_day" class="form-control"
                        value="{{ old('price_per_day') }}" required>
                    @error('price_per_day')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="licence_plate" class="form-label">Plat Mobil</label>
                <input type="text" id="licence_plate" name="licence_plate" class="form-control"
                    value="{{ old('licence_plate') }}" required>
                @error('licence_plate')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="rented" {{ old('status') == 'rented' ? 'selected' : '' }}>Disewa</option>
                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Dalam Pemeliharaan
                    </option>
                    <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia
                    </option>
                    <option value="need_confirmation" {{ old('status') == 'need_confirmation' ? 'selected' : '' }}>Butuh
                        Konfirmasi
                    </option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('cars.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
