@extends('layouts.main')

@section('content')
    <div class="container">
        <h1><i>{{ $car->name }}</i></h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Details</h5>
                <p class="card-text"><strong>Licence Plate:</strong> {{ $car->licence_plate }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $car->status }}</p>
                <p class="card-text"><strong>Price:</strong> Rp. {{ $car->price_per_day }}</p>
                <p class="card-text"><strong>Brand:</strong>{{ $car->category->brand }}</p>
                <p class="card-text"><strong>Model:</strong> {{ $car->category->model ?? '-' }}</p>
                <p class="card-text"><strong>Price:</strong> Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</p>
            </div>
        </div>
        <a href="{{ route('cars.index') }}" class="btn btn-primary mt-3">Back to Cars List</a>
    </div>
@endsection
