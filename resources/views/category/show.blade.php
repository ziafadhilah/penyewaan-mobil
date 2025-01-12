@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Category Details</h1>
        <div class="card">
            <div class="card-header">
                {{ $category->brand }}
            </div>
            <div class="card-body">
                {{-- <p><strong>ID:</strong> {{ $category->id }}</p> --}}
                <p><strong>Model:</strong> {{ $category->model }}</p>
                <p><strong>Tahun:</strong> {{ $category->year }}</p>
            </div>
        </div>
        <a href="{{ route('category.index') }}" class="btn btn-primary mt-3">Back to Categories</a>
    </div>
@endsection
