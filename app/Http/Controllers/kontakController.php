<?php

namespace App\Http\Controllers;

use App\Models\KontakKami;
use Illuminate\Http\Request;

class kontakController extends Controller
{
    // direktori blade 
    protected $direktori = 'cms.kontak_kami';

    public function index()
    {        
        $data = KontakKami::first();
        return view($this->direktori . '.index', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        // fungsi update data
        $profil = KontakKami::findOrFail($id);

        $profil->email = $request->email;
        $profil->phone = $request->phone;
        $profil->location = $request->location;
        $profil->maps = $request->maps;
        $profil->instagram = $request->instagram;
        $profil->url_instagram = $request->url_instagram;
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('kontak-kami');
    }
}
