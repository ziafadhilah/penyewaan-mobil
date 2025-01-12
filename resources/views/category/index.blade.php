@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Kategori</h1>

        <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Brand / Merk</th>
                    <th>Model</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->brand }}</td>
                        <td>{{ $category->model }}</td>
                        <td>{{ $category->year }}</td>
                        <td>
                            {{-- <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada kategori tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
