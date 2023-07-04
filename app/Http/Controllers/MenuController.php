<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoremenuRequest;
use App\Http\Requests\UpdatemenuRequest;
use App\Models\menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => menu::all(),
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
    public function store(StoremenuRequest $request)
    {
        $validated = $request->validate([
            'namamenu' => 'required|String|unique:menus,namamenu',
            'id_namatoko' => 'required|integer',
            'id_jenismakanan' => 'required|integer',
        ]);
        $hasil = menu::create([
            'namamenu' => $validated['namamenu'],
            'id_namatoko' => $validated['id_namatoko'],
            'id_jenismakanan' => $validated['id_jenismakanan'],
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
    public function show(menu $menu)
    {
        return response()->json([
            'message' => 'success',
            'data' => $menu,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(menu $menu)
    {
        return response()->json([
            'message' => 'success',
            'data' => $menu,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemenuRequest $request, menu $menu)
    {
        $validated = $request->validate([
            'namamenu' => 'required|String',
            'id_namatoko' => 'required|integer',
            'id_jenismakanan' => 'required|integer',
        ]);
        $hasil = $menu->update([
            'namamenu' => $validated['namamenu'],
            'id_namatoko' => $validated['id_namatoko'],
            'id_jenismakanan' => $validated['id_jenismakanan'],

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
    public function destroy(menu $menu)
    {
        $hasil = $menu->delete();
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
