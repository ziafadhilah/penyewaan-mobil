<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
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
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
