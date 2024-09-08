<?php

namespace App\Http\Controllers;

use App\Helpers\TranslateTextHelper;
use App\Models\Landing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class landingController extends Controller
{
    //direktori blade
    protected $direktori = 'cms.menejemen_beranda.landing';

    public function index()
    {
        $data = Landing::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        // json untuk datatable 
        $data = Landing::select("id","gambar","nama_perusahaan","motto","deskripsi")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_landing(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_landing(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('gambar',function ($data) {
                //menampilkan gammbar didalam datatable
                $alt = $data['gambar'];
                $img = '<img src="' . asset('images/landing/' . $alt) . '" alt="' . $alt . '" max-height="174px" width="174px" onerror="this.style.display=\'none\'">';
                return $img;
            })            
            ->addColumn('deskripsi', function($data) {
                // str limit untuk membatasi string yang terlalu panjang
                return strlen($data->deskripsi) > 20 ? substr($data->deskripsi, 0, 50) . '...' : $data->deskripsi;
            })         
            ->rawColumns(['opsi', 'gambar','deskripsi'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // menampilkan halaman tmbah data
        return view($this->direktori . '.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        // fungsi tambah data
        $profil = new Landing();

        if ($request->hasFile('gambar')) { // cek apakah ada request file
            $image = $request->file('gambar'); // jikaada maka ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // membuat nama file -> stempel waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/landing'); // direktori file disimpan
            $image->move($destinationPath, $imageName); // menyimpan file ke direktori

            $profil->gambar = $imageName; //menyimpan nama file ke database
        }
        $profil->nama_perusahaan = $request->nama_perusahaan;
        $profil->motto = $request->motto;
        $profil->motto_en = $request->motto_en;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->save();

        session()->flash('sukses', 'Tambah Data Berhasil');
        return redirect()->route('manajemen-landing-page');
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
        // menampikan halaman ubah data
        $data = Landing::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // fungsi update data
        $profil = Landing::findOrFail($id);

        if ($request->hasFile('gambar')) { // cek apakah ada request file
            $image = $request->file('gambar'); // jika ada maka ambil filennya
            $imageName = time().'.'.$image->getClientOriginalExtension(); //membuat nama file => stempel waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/landing'); // direktori file disimpan
            
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
        $profil->nama_perusahaan = $request->nama_perusahaan;
        $profil->motto = $request->motto;
        $profil->motto_en = $request->motto_en;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('manajemen-landing-page');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // fungsi hapus data
        $data = Landing::findOrFail($id);
        $thumbnailName = $data->gambar; // ambil nama file yang akan dihapus
        $delete = $data->delete(); // hapus data 

        if ($delete) {
            if ($thumbnailName) { //hapus file lama jika ada
                $thumbnailPath = public_path('/images/landing/' . $thumbnailName);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('manajemen-landing-page');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('manajemen-landing-page');
        }
    }

    public function translate(Request $request)
    {
        // fungsi translate kata

        // memanggil helper dan set dari bahasa indonesia dan akan di translate ke bahasa inggris
        TranslateTextHelper::setSource('id')->setTarget('en');
        //simpan hasil translate 
        $translatedText = TranslateTextHelper::translate($request->text);
        //kirim dengan response json
        return response()->json(['text' => $translatedText]);
    }

    public function update_nilai_status(Request $request)
    {
        //  fungsi mengubah status nilai (gambar atau ikon)
        $data = User::first();
        $data->status_nilai = $request->status_nilai;
        $data->save();
        
        return response()->json(['message' => 'Status updated successfully']);
    }

    public function update_nilai_calendar(Request $request)
    {
        // fungsi mengubah status kalendar (tampil atau tidak)
        $data = User::first();
        $data->status_calendar = $request->status_calendar;
        $data->save();
        
        return response()->json(['message' => 'Status updated successfully']);
    }
}
