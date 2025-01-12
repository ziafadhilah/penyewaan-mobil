<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\Category;
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

        // dd($request->all());
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'car_id' => 'required|exists:cars,id',
        //     'rented_at' => 'required|date',
        //     'due_date' => 'required|date|after_or_equal:rented_at',
        //     'status' => 'required|in:pending,completed,overtime',
        //     'total_price' => 'required|integer',
        // ]);

        $rental = new Rental();
        $rental->user_id = '1';
        $rental->car_id = $request->car_id;
        $rental->rented_at = $request->rented_at;
        $rental->due_date = $request->due_date;
        $rental->status = $request->status;
        $rental->total_price = $request->total_price;
        $rental->save();

        return redirect()->route('rent.index')->with('success', 'Rental created successfully.');
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
    public function edit(Rental $rental)
    {
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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'rented_at' => 'required|date',
            'due_date' => 'required|date|after_or_equal:rented_at',
            'status' => 'required|in:pending,completed,overtime',
            'total_price' => 'required|integer',
        ]);

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
