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
        $validated = $request->validate([
            'namatoko' => 'required|String|unique:namatokos,namatoko',
        ]);
        $hasil = namatoko::create([
            'namatoko' => $validated['namatoko'],
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

    public function show(namatoko $namatoko)
    {
        return response()->json([
            'message' => 'success',
            'data' => $namatoko,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(namatoko $namatoko)
    {
        return response()->json([
            'message' => 'success',
            'data' => $namatoko,
        ], 200);
    }


    public function update(UpdatenamatokoRequest $request, namatoko $namatoko)
    {
        $validated = $request->validate([
            'namatoko' => 'required|String',
        ]);

        $hasil = $namatoko->update(['namatoko' => $validated['namatoko']]);
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
    public function destroy(namatoko $namatoko)
    {
        $hasil = $namatoko->delete();
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
