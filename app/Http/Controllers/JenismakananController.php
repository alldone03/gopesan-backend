<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorejenismakananRequest;
use App\Http\Requests\UpdatejenismakananRequest;
use App\Models\jenismakanan;

class JenismakananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => jenismakanan::all(),
        ], 200);
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
    public function store(StorejenismakananRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(jenismakanan $jenismakanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenismakanan $jenismakanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejenismakananRequest $request, jenismakanan $jenismakanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenismakanan $jenismakanan)
    {
        //
    }
}
