<?php

namespace App\Http\Controllers;

use App\Models\Returned;
use Illuminate\Http\Request;

class ReturnedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returned = Returned::with('rental')->get();
        return view('returned.index', [
            'returned' => $returned
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Returned $returned)
    {
        // Tampilkan informasi tentang objek Returned
        return [
            'id' => $returned->id,
            'rental_id' => $returned->rental_id,
            'returned_at' => $returned->returned_at,
            'late_fee' => $returned->late_fee,
            'damage_fee' => $returned->damage_fee,
            'contidition_notes' => $returned->contidition_notes,
            'status' => $returned->status,
        ];
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Returned $returned)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Returned $returned)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Returned $returned)
    {
        //
    }
}
