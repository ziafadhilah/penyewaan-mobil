@extends('layouts.main')

@section('content')
    <div class="container" id="rent-create">
        <h1>Create New Rental</h1>
        <form action="{{ route('rent.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="car_id">Car</label>
                <select name="car_id" id="car_id" class="form-control" v-model="selectedCarId" @change="updateTotalPrice">
                    <option value="">Pilih Mobil</option>
                    @foreach ($cars as $car)
                        <option value="{{ $car->id }}" :data-price="{{ $car->price }}">
                            {{ $car->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="total_price">Harga Per-hari</label>
                <input type="number" name="total_price" id="total_price" class="form-control" v-model="totalPrice"
                    readonly>
            </div>
            <div class="form-group mb-3">
                <label for="rented_at">Rental Date</label>
                <input type="date" name="rented_at" id="rented_at" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="due_date">Return Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create Rental</button>
        </form>
    </div>
@endsection
@section('pagescript')
    <script>
        const {
            createApp
        } = Vue;

        createApp({
            data() {
                return {
                    selectedCarId: null,
                    totalPrice: 0,
                    carPrices: {
                        @foreach ($cars as $car)
                            {{ $car->id }}: {{ $car->price_per_day }},
                        @endforeach
                    }
                }
            },
            methods: {
                updateTotalPrice() {
                    this.totalPrice = this.carPrices[this.selectedCarId] || 0;
                }
            }
        }).mount('#rent-create');
    </script>
@endsection
