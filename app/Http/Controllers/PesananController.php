<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepesananRequest;
use App\Http\Requests\UpdatepesananRequest;
use App\Models\pesanan;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => pesanan::all(),
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
    public function store(StorepesananRequest $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|integer',
            'id_toko' => 'required|integer',
            'id_menu' => 'required|integer',
            'id_varian' => 'required|integer',
            'id_jenismakanan' => 'required|integer',
            'id_harga' => 'required|integer',

        ]);
        $hasil = pesanan::create([
            'id_user' => $validated['id_user'],
            'id_toko' => $validated['id_toko'],
            'id_menu' => $validated['id_menu'],
            'id_varian' => $validated['id_varian'],
            'id_jenismakanan' => $validated['id_jenismakanan'],
            'id_harga' => $validated['id_harga'],

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
    public function show(pesanan $pesanan)
    {
        return response()->json([
            'message' => 'success',
            'data' => $pesanan,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pesanan $pesanan)
    {
        return response()->json([
            'message' => 'success',
            'data' => $pesanan,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepesananRequest $request, pesanan $pesanan)
    {
        $validated = $request->validate([
            'id_user' => 'required|integer',
            'id_toko' => 'required|integer',
            'id_menu' => 'required|integer',
            'id_varian' => 'required|integer',
            'id_jenismakanan' => 'required|integer',
            'id_harga' => 'required|integer',

        ]);
        $hasil = $pesanan->update([
            'id_user' => $validated['id_user'],
            'id_toko' => $validated['id_toko'],
            'id_menu' => $validated['id_menu'],
            'id_varian' => $validated['id_varian'],
            'id_jenismakanan' => $validated['id_jenismakanan'],
            'id_harga' => $validated['id_harga'],

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
    public function destroy(pesanan $pesanan)
    {
        $hasil = $pesanan->delete();
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
