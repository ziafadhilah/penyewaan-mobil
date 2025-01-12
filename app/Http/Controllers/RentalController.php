<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentals = Rental::with('car')->get();
        return view('rent.index', [
            'cars' => $rentals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::all();
        return view('rent.create', [
            'cars' => $cars
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $car = Car::findOrFail($request->car_id);
            $pricePerDay = $car->price_per_day;

            // Hitung jumlah hari rental
            $rentedAt = Carbon::parse($request->rented_at);
            $dueDate = Carbon::parse($request->due_date);
            $rentalDays = $rentedAt->diffInDays($dueDate) + 1; // Tambahkan 1 hari untuk hari pertama

            // Hitung total harga
            $totalPrice = $pricePerDay * $rentalDays;

            // Simpan data rental ke database
            $rental = new Rental();
            $rental->user_id = '1';
            $rental->car_id = $request->car_id;
            $rental->rented_at = $request->rented_at;
            $rental->due_date = $request->due_date;
            $rental->status = 'pending';
            $rental->total_price = $totalPrice;
            $rental->save();
            $car->status = 'need_confirmation';
            $car->save();
            DB::commit();
            return redirect()->route('rent.index')->with('success', 'Rental created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('rent.index')->with('error', 'Rental creation failed.', $th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        return view('rent.show', [
            'rental' => $rental
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rental = Rental::findOrFail($id);
        $cars = Car::all();
        return view('rent.edit', [
            'rental' => $rental,
            'cars' => $cars
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        $rental->user_id = $request->user_id;
        $rental->car_id = $request->car_id;
        $rental->rented_at = $request->rented_at;
        $rental->due_date = $request->due_date;
        $rental->status = $request->status;
        $rental->total_price = $request->total_price;
        $rental->save();

        return redirect()->route('rent.index')->with('success', 'Rental updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
        $rental->delete();
        return redirect()->route('rent.index')->with('success', 'Rental deleted successfully.');
    }
}
