<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorevarianRequest;
use App\Http\Requests\UpdatevarianRequest;
use App\Models\menu;
use App\Models\namatoko;
use App\Models\varian;

class VarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => varian::join('menus', 'varians.id_menu', '=', 'menus.id')->join('namatokos', 'varians.id_toko', '=', 'namatokos.id')->select("varians.*", "menus.namamenu", 'namatokos.namatoko')->get()
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
    public function store(StorevarianRequest $request)
    {
        $validated = $request->validate([
            'varian' => 'required|String',
            'id_menu' => 'required|integer',
        ]);
        $dataMenu = menu::find($validated['id_menu']);

        $hasil = varian::create([
            'varian' => $validated['varian'],
            'id_menu' => $validated['id_menu'],
            'id_toko' => $dataMenu->id_namatoko,
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
    public function show(varian $varian)
    {
        return response()->json([
            'message' => 'success',
            'data' => $varian,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(varian $varian)
    {
        return response()->json([
            'message' => 'success',
            'data' => $varian,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatevarianRequest $request, varian $varian)
    {
        $validated = $request->validate([
            'varian' => 'required|String',
            'id_menu' => 'required|integer',

        ]);
        $hasil = $varian->update([
            'varian' => $validated['varian'],
            'id_menu' => $validated['id_menu'],

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
    public function destroy(varian $varian)
    {
        $hasil = $varian->delete();
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
