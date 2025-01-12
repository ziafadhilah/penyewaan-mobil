<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cars = Car::query();

        if ($request->has('category_id') && $request->category_id != '') {
            $cars->where('category_id', $request->category_id);
        }

        if ($request->has('name') && $request->name != '') {
            $cars->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $cars->where('status', $request->status);
        }

        return view('cars.index', [
            'cars' => $cars->with('category')->get(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('cars.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $car = new Car;
            $car->name = $request->name;
            $car->category_id = $request->category_id;
            $car->licence_plate = $request->licence_plate;
            $car->status = $request->status;
            $car->price_per_day = $request->price_per_day;
            $car->save();
            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Car created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error creating car', $th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = Car::with('category')->findOrFail($id);
        return view('cars.show', [
            'car' => $car,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();
        $car = Car::with('category')->findOrFail($id);
        return view('cars.edit', [
            'car' => $car,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $car = Car::findOrFail($id);
            $car->name = $request->name;
            $car->category_id = $request->category_id;
            $car->licence_plate = $request->licence_plate;
            $car->status = $request->status;
            $car->price_per_day = $request->price_per_day;
            $car->save();
            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Car updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error updating car', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $car = Car::findOrFail($request->id);
            $car->delete();
            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Car deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error deleting car', $th);
        }
    }

    public function confirm($id)
    {
        DB::beginTransaction();
        try {
            $car = Car::findOrFail($id);

            if ($car->status !== 'need_confirmation') {
                return redirect()->route('cars.index')->with('error', 'Status mobil tidak valid untuk konfirmasi.');
            }

            // Ubah status mobil menjadi 'available'
            $car->status = 'rented';
            $car->save();

            // Perbarui status pada tabel rent yang terkait dengan mobil ini
            $rental = Rental::where('car_id', $id)->where('status', 'pending')->first();

            if ($rental) {
                $rental->status = 'confirmed';
                $rental->save();
            }

            DB::commit();
            return redirect()->route('cars.index')->with('success', 'Status mobil dan rental berhasil dikonfirmasi.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('cars.index')->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
