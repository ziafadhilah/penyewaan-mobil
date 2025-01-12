@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Car</h1>
        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 col-lg-6">
                <label for="name" class="form-label">Nama Mobil</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $car->name) }}"
                    required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select id="category_id" name="category_id" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $car->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->brand }}
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
                        value="{{ old('price_per_day', $car->price_per_day) }}" required>
                    @error('price_per_day')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="licence_plate" class="form-label">Plat Mobil</label>
                <input type="text" id="licence_plate" name="licence_plate" class="form-control"
                    value="{{ old('licence_plate', $car->licence_plate) }}" required>
                @error('licence_plate')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Tersedia
                    </option>
                    <option value="rented" {{ old('status', $car->status) == 'rented' ? 'selected' : '' }}>Disewa</option>
                    <option value="maintenance" {{ old('status', $car->status) == 'maintenance' ? 'selected' : '' }}>Dalam
                        Pemeliharaan
                    </option>
                    <option value="unavailable" {{ old('status', $car->status) == 'unavailable' ? 'selected' : '' }}>Tidak
                        Tersedia
                    </option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Car</button>
        </form>
    </div>
@endsection
