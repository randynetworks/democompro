<?php

namespace App\Http\Controllers;

use App\Models\Landing;
use Illuminate\Http\Request;

class XlandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Landing::all();
        return view('landing.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('landing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $landing = new Landing();

        // Mengelola gambar yang diunggah
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('images'), $nama_gambar);
            $landing->gambar = $nama_gambar;
        }

        // Menyimpan data yang diinput ke dalam model
        $landing->nama_perusahaan = $request->nama_perusahaan;
        $landing->motto = $request->motto;
        $landing->deskripsi = $request->deskripsi;
        $landing->save();

        // Mengembalikan ke halaman index dengan pesan sukses
        return redirect()->route('landing.index')->with('success', 'Data landing page berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gambar = Landing::find($id);
        return view('landing.show', compact('gambar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gambar = Landing::find($id);
        return view('landing.edit', compact('gambar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $landing = Landing::find($id);

        // Mengelola gambar yang diunggah
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('images'), $nama_gambar);
            $landing->gambar = $nama_gambar;
        }

        // Memperbarui data yang diinput ke dalam model
        $landing->nama_perusahaan = $request->nama_perusahaan;
        $landing->motto = $request->motto;
        $landing->deskripsi = $request->deskripsi;
        $landing->save();

        // Mengembalikan ke halaman index dengan pesan sukses
        return redirect()->route('landing.index')->with('success', 'Data landing page berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $landing = Landing::find($id);
        $landing->delete();

        // Mengembalikan ke halaman index dengan pesan sukses
        return redirect()->route('landing.index')->with('success', 'Data landing page berhasil dihapus.');
    }
}
