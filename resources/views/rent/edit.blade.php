@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Edit Rental</h1>
        <form action="{{ route('rent.update', $rental->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="car">Car</label>
                <select name="car_id" id="car" class="form-control">
                    @foreach ($cars as $car)
                        <option value="{{ $car->id }}" {{ $rental->car_id == $car->id ? 'selected' : '' }}>
                            {{ $car->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="customer">Customer</label>
                <input type="text" name="customer" id="customer" class="form-control" value="{{ $rental->customer }}">
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="{{ $rental->start_date }}">
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $rental->end_date }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Rental</button>
        </form>
    </div>
@endsection
