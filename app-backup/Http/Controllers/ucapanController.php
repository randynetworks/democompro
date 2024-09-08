<?php

namespace App\Http\Controllers;

use App\Models\MasterJabatan;
use App\Models\Ucapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class ucapanController extends Controller
{
    protected $direktori = 'cms.menejemen_beranda.ucapan';

    public function index()
    {
        $data = Ucapan::select('ucapans.id','ucapans.gambar','ucapans.nama','ucapans.id_jabatan_fk','ucapans.deskripsi','ucapans.deskripsi_en','ucapans.tagline','ucapans.tagline_en','master_jabatans.id','master_jabatans.jabatan','master_jabatans.jabatan_en', 'master_jabatans.level')
        ->leftJoin('master_jabatans', 'ucapans.id_jabatan_fk', '=', 'master_jabatans.id')
        ->first();
        $id_ucapan = Ucapan::select('id')->first();
        
        $imagePath = public_path('images/ucapan/' . $data->gambar);
        $data->imageExists = File::exists($imagePath);

        $data_jabatan = MasterJabatan::all();

        return view($this->direktori . '.index', compact('data','data_jabatan','id_ucapan'));
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {    
        // 
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        // 
    }

    public function update(Request $request, string $id)
    {
        $profil = Ucapan::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/ucapan');
            // Hapus file lama jika ada
            if ($profil->gambar) {
                $oldImagePath = $destinationPath . '/' . $profil->gambar;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image->move($destinationPath, $imageName);

            $profil->gambar = $imageName;
        }
        $profil->nama = $request->nama;
        $profil->id_jabatan_fk = $request->id_jabatan_fk;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->tagline = $request->tagline;
        $profil->tagline_en = $request->tagline_en;
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('manajemen-ucapan');
    }

    public function destroy(string $id)
    {
        // 
    }
}
