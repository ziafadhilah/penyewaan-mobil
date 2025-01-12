@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create New Rental</h1>
        <form action="{{ route('rent.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="car_id">Car</label>
                <select name="car_id" id="car_id" class="form-control">
                    @foreach ($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="customer_id">Customer</label>
                <select name="customer_id" id="customer_id" class="form-control">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="rental_date">Rental Date</label>
                <input type="date" name="rental_date" id="rental_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="return_date">Return Date</label>
                <input type="date" name="return_date" id="return_date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create Rental</button>
        </form>
    </div>
@endsection
