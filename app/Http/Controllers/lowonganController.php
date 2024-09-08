<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class lowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    // direktori blade
    protected $direktori = 'cms.menejemen_beranda.lowongan';
    
    public function index()
    {
        //  get data -> karna hanya ada 1 data maka menggunakan first
        $data = Lowongan::first();
        return view($this->direktori . '.index', compact('data'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //  fungsi update data
        $profil = Lowongan::findOrFail($id);

        $profil->url = $request->url;
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('manajemen-karir');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
