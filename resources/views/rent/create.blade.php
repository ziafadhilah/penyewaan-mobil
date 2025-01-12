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
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="overtime">Overtime</option>
                </select>
            </div>
            <div class="form-group">
                <label for="total_price">Total Price</label>
                <input type="number" name="total_price" id="total_price" class="form-control">
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
                <label for="rented_at">Rental Date</label>
                <input type="date" name="rented_at" id="rented_at" class="form-control">
            </div>
            <div class="form-group">
                <label for="due_date">Return Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create Rental</button>
        </form>
    </div>
@endsection
