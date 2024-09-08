<?php

namespace App\Http\Controllers;

use App\Models\Tujuan;
use Illuminate\Http\Request;

class tujuanController extends Controller
{
    // direktori blade
    protected $direktori = 'cms.menejemen_perusahaan.tujuan';

    public function index()
    {        
        //get data first dari tabel tujuan  (karna hanya ada 1 data)
        $data = Tujuan::first();
        return view($this->direktori . '.index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // fungsi update
        $profil = Tujuan::findOrFail($id);

        $profil->tujuan = $request->tujuan;
        $profil->tujuan_en = $request->tujuan_en;
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('tujuan-perusahaan');
    }
}
