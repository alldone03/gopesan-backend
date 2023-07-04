<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepictureRequest;
use App\Http\Requests\UpdatepictureRequest;
use App\Models\picture;
use Intervention\Image\Facades\Image as convertImage;
use Illuminate\Support\Facades\File;


class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message' => 'success',
            'data' => picture::all(),
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
    public function store(StorepictureRequest $request)
    {
        $validated = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'required|String',
            'id_jenismakanan' => 'required|integer',
            'id_varian' => 'required|integer',
            'id_toko' => 'required|integer',
        ]);

        $webp_image = convertImage::make($request->file('file'))->encode('webp', 90)->save('storage/images/' . $request->file('file')->hashName() . '.webp');

        $hasil = picture::create([
            'file' => $webp_image->basePath(),
            'keterangan' => $validated['keterangan'],
            'id_jenismakanan' => $validated['id_jenismakanan'],
            'id_varian' => $validated['id_varian'],
            'id_toko' => $validated['id_toko'],
        ]);
        if (!$hasil)
            return response()->json([
                'message' => 'Data gagal ditambahkan',
            ], 400);
        else
            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                // 'data' =>  $request->getHttpHost() . "/" . $webp_image->basePath()
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(picture $picture)
    {
        return response()->json([
            'message' => 'success',
            'data' => $picture,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(picture $picture)
    {
        return response()->json([
            'message' => 'success',
            'data' => $picture,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepictureRequest $request, picture $picture)
    {
        dd($request->all());
        $validated = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'required|String',
            'id_jenismakanan' => 'required|integer',
            'id_varian' => 'required|integer',
            'id_toko' => 'required|integer',
        ]);
        unlink(public_path($picture->file));

        $webp_image = convertImage::make($request->file('file'))->encode('webp', 90)->save('storage/images/' . $request->file('file')->hashName() . '.webp');


        $hasil = $picture->update([
            'file' => $webp_image->basePath(),
            'keterangan' => $validated['keterangan'],
            'id_jenismakanan' => $validated['id_jenismakanan'],
            'id_varian' => $validated['id_varian'],
            'id_toko' => $validated['id_toko'],
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
    public function destroy(picture $picture)
    {
        unlink(public_path($picture->file));
        $hasil = $picture->delete();
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
