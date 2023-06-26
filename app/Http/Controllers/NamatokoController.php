<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorenamatokoRequest;
use App\Http\Requests\UpdatenamatokoRequest;
use App\Models\namatoko;

class NamatokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => namatoko::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorenamatokoRequest $request)
    {
        $validated = $request->validated([
            'nama_toko' => 'required|unique:namatokos,namatoko',
        ]);
        namatoko::create([
            'namatoko' => $validated['nama_toko'],
        ]);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(namatoko $namatoko)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(namatoko $namatoko)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatenamatokoRequest $request, namatoko $namatoko)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(namatoko $namatoko)
    {
        //

    }
}
