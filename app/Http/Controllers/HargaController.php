<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorehargaRequest;
use App\Http\Requests\UpdatehargaRequest;
use App\Models\harga;


class HargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => harga::all(),
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
    public function store(StorehargaRequest $request)
    {
        $validated = $request->validate([
            'harga' => 'required|integer',
            'id_toko' => 'required|integer',
            'id_menu' => 'required|integer',
            'id_varian' => 'required|integer',
            'id_jenis' => 'required|integer',
        ]);
        $hasil = harga::create([
            'harga' => $validated['harga'],
            'id_toko' => $validated['id_toko'],
            'id_menu' => $validated['id_menu'],
            'id_varian' => $validated['id_varian'],
            'id_jenis' => $validated['id_jenis'],
        ]);
        if (!$hasil)
            return response()->json([
                'message' => 'Data gagal ditambahkan',
            ], 400);
        else
            return response()->json([
                'message' => 'Data berhasil ditambahkan',
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(harga $harga)
    {
        return response()->json([
            'message' => 'success',
            'data' => $harga,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(harga $harga)
    {
        return response()->json([
            'message' => 'success',
            'data' => $harga,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatehargaRequest $request, harga $harga)
    {
        $validated = $request->validate([
            'harga' => 'required|integer',
            'id_toko' => 'required|integer',
            'id_menu' => 'required|integer',
            'id_varian' => 'required|integer',
            'id_jenis' => 'required|integer',
        ]);
        $hasil = $harga->update([
            'harga' => $validated['harga'],
            'id_toko' => $validated['id_toko'],
            'id_menu' => $validated['id_menu'],
            'id_varian' => $validated['id_varian'],
            'id_jenis' => $validated['id_jenis'],

        ]);
        if (!$hasil)
            return response()->json([
                'message' => 'Data gagal diubah',
            ], 400);
        else
            return response()->json([
                'message' => 'Data berhasil Diubah',
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(harga $harga)
    {
        $hasil = $harga->delete();
        if (!$hasil)
            return response()->json([
                'message' => 'Data gagal dihapus',
            ], 400);
        else {
            return response()->json([
                'message' => 'Data berhasil dihapus',
            ], 200);
        }
    }
}
