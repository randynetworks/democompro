<?php

namespace App\Http\Controllers;

use App\Models\MasterJabatan;
use App\Models\Ucapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class ucapanController extends Controller
{
    // direktori blade
    protected $direktori = 'cms.menejemen_beranda.ucapan';

    public function index()
    {
        //get data ucapan sambutan dengan relasi ke master jabatan
        $data = Ucapan::select('ucapans.id','ucapans.gambar','ucapans.nama','ucapans.id_jabatan_fk','ucapans.deskripsi','ucapans.deskripsi_en','ucapans.tagline','ucapans.tagline_en','master_jabatans.id','master_jabatans.jabatan','master_jabatans.jabatan_en', 'master_jabatans.level')
        ->leftJoin('master_jabatans', 'ucapans.id_jabatan_fk', '=', 'master_jabatans.id')
        ->first();
        $id_ucapan = Ucapan::select('id')->first();
        
        // cek apakah data gambar ada atau tidak
        $imagePath = public_path('images/ucapan/' . $data->gambar);
        $data->imageExists = File::exists($imagePath);

        //get data master jabataan
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
        // fungsi update
        $profil = Ucapan::findOrFail($id);

        if ($request->hasFile('gambar')) { // cek apakah ada request file
            $image = $request->file('gambar'); // jka ada maka ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // membuat nama file => stemple waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/ucapan'); // direktori file disimpan
            // cek apakah ada file lama di direktori
            if ($profil->gambar) {
                $oldImagePath = $destinationPath . '/' . $profil->gambar;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath); // jika ada maka hapus
                }
            }
            $image->move($destinationPath, $imageName); // simpan file baru di direktori

            $profil->gambar = $imageName; // simpan nama file di database
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
