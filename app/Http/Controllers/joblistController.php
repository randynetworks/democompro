<?php

namespace App\Http\Controllers;

use App\Models\Joblist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class joblistController extends Controller
{
    // direktoti blade
    protected $direktori = 'cms.daftar_lowongan';

    public function index()
    {
        $data = Joblist::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        $data = Joblist::select("id","gambar","judul","deskripsi","waktu")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_job(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_job(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('gambar',function ($data) {
                // menampilkkan gambar di datatable
                $alt = $data['gambar'];
                $img = '<img src="' . asset('images/joblist/' . $alt) . '" alt="' . $alt . '" max-height="174px" width="174px" onerror="this.style.display=\'none\'">';

                return $img;
            })
            ->addColumn('judul', function($data) {
                // str limit untuk membatasi string yang terlalu panjang
                return strlen($data->judul) > 20 ? substr($data->judul, 0, 35) . '...' : $data->judul;
            }) 
            ->rawColumns(['opsi', 'gambar'])
            ->make();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // menampilkan halaman tambah data
        return view($this->direktori . '.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // fungsi tambah data
        $profil = new Joblist();

        if ($request->hasFile('gambar')) { // cek apakah ada request file
            $image = $request->file('gambar'); // jika ada ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // mmebuat nama file -> stempel waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/joblist'); //direktori file disimpan
            $image->move($destinationPath, $imageName); // menyimpan file ke direktoi

            $profil->gambar = $imageName; // menyimpan nama file ke datatbase
        }
        $profil->judul = $request->judul;
        $profil->judul_en = $request->judul_en;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->waktu = $request->waktu;
        $profil->slug = Str::slug($request->judul. '-' . $profil->id);
        $profil->save();

        session()->flash('sukses', 'Tambah Data Berhasil');

        return redirect()->route('manajemen-daftar-lowongan');
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
        // menampilkan halmaan ubah data
        $data = Joblist::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // fungsi update data
        $profil = Joblist::findOrFail($id);

        if ($request->hasFile('gambar')) {  //cek apakah ada request file
            $image = $request->file('gambar'); //jika ada ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); //membuat nama file => stempel waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/joblist'); // direktori file disimpan

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
        $profil->judul = $request->judul;
        $profil->judul_en = $request->judul_en;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->waktu = $request->waktu;
        $profil->slug = Str::slug($request->judul. '-' . $profil->id);
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('manajemen-daftar-lowongan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Joblist::findOrFail($id);

        // ambil nama file gambar sebelum menghapus data
        $gambarName = $data->gambar;

        // Hapus data BeritaArtikel dari basis data
        $delete = $data->delete();

        if ($delete) {
            // Jika data berhasil dihapus, hapus juga file gambar terkait jika ada
            if ($gambarName) {
                $gambarPath = public_path('/images/joblist/' . $gambarName);
                if (File::exists($gambarPath)) {
                    File::delete($gambarPath);
                }
            }
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('manajemen-daftar-lowongan');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('manajemen-daftar-lowongan');
        }
    }
}
