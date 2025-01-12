@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Kategori Baru</h1>

        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="brand" class="form-label">Brand / Merek</label>
                <input type="text" id="brand" name="brand" class="form-control" value="{{ old('brand') }}" required>
                @error('brand')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" id="model" name="model" class="form-control" value="{{ old('model') }}"
                    required>
                @error('model')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Tahun</label>
                <input type="text" id="year" name="year" class="form-control" value="{{ old('year', '2025') }}"
                    placeholder="Contoh: 2025" pattern="\d{4}" inputmode="numeric"
                    title="Masukkan tahun dalam format 4 digit (misalnya 2025)" required>
                @error('year')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('category.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
@section('pagescript')
    <script>
        document.getElementById('year').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
@endsection
