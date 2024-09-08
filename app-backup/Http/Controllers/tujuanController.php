<?php

namespace App\Http\Controllers;

use App\Models\Tujuan;
use Illuminate\Http\Request;

class tujuanController extends Controller
{
    protected $direktori = 'cms.menejemen_perusahaan.tujuan';

    public function index()
    {        
        $data = Tujuan::where('id', 1)->first();

        return view($this->direktori . '.index', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profil = Tujuan::findOrFail($id);

        $profil->tujuan = $request->tujuan;
        $profil->tujuan_en = $request->tujuan_en;
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('tujuan-perusahaan');
    }
}
