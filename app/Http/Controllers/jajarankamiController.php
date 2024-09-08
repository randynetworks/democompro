<?php

namespace App\Http\Controllers;

use App\Models\JajaranKami;
use App\Models\MasterJabatan;
use Database\Seeders\JajaranKamiSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class jajarankamiController extends Controller
{
    // direktori blade
    protected $direktori = 'cms.menejemen_tentang_kami.jajaran_kami';

    public function index()
    {
        $data = JajaranKami::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        // get data jajaran kami join dengan master jabatan
        $data = JajaranKami::select('jajaran_kamis.id', 'jajaran_kamis.gambar', 'jajaran_kamis.nama', 'jajaran_kamis.deskripsi',
        'jajaran_kamis.tagline', 'jajaran_kamis.tagline_en',
        'jajaran_kamis.id_jabatan_fk', 'master_jabatans.jabatan', 'master_jabatans.level')
        ->leftJoin('master_jabatans', 'jajaran_kamis.id_jabatan_fk', '=', 'master_jabatans.id');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_jajaran(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_jajaran(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('gambar',function ($data) {
                // menampilkan gambar di dalam datatable
                $alt = $data['gambar'];
                $img = '<img src="' . asset('images/jajaran-kami/' . $alt) . '" alt="' . $alt . '" max-height="174px" width="174px" onerror="this.style.display=\'none\'">';

                return $img;
            })
            ->editColumn('jabatan',function ($data) {
                // mmbuat badge untuk jabatan
                if ($data->level == 1) {
                    $jabatan = '<div class="badge badge-light-success">'. $data->jabatan.'</div>';
                }else if ($data->level == 2) {
                    $jabatan = '<div class="badge badge-light-warning">'. $data->jabatan.'</div>';
                }else if ($data->level == 3) {
                    $jabatan = '<div class="badge badge-light-primary">'. $data->jabatan.'</div>';
                }else{
                    $jabatan = '<div class="badge badge-light-danger">'. $data->jabatan.'</div>';
                }
                return $jabatan;
            })
            ->editColumn('nama', function($data) {
                // str limit untuk membatasi string yang terlalu panjang
                return strlen($data->nama) > 20 ? substr($data->nama, 0, 20) . '...' : $data->nama;
            })
            ->editColumn('deskripsi', function($data) {
                // str limit untuk membatasi string yang terlalu panjang
                return strlen($data->deskripsi) > 20 ? substr($data->deskripsi, 0, 50) . '...' : $data->deskripsi;
            })
            ->rawColumns(['opsi', 'gambar','jabatan','deskripsi','nama']) // render html didalam datatable
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_jabatan = MasterJabatan::all();
        return view($this->direktori . '.create', compact('data_jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $profil = new JajaranKami();

        if ($request->hasFile('gambar')) { // cek apakah ada requets file 
            $image = $request->file('gambar'); // jika ada ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // membuat nama file -> waktu unix saat ini + extensi file asli

            $destinationPath = public_path('/images/jajaran-kami'); // irektori file disimpan
            $image->move($destinationPath, $imageName); // menyimpan file ke direktori

            $profil->gambar = $imageName; // simpan nama file ke datatabase
        }
        $profil->nama = $request->nama;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->id_jabatan_fk = $request->id_jabatan_fk;
        $profil->tagline = $request->tagline;
        $profil->tagline_en = $request->tagline_en;
        $profil->save();

        session()->flash('sukses', 'Tambah Data Berhasil');

        return redirect()->route('struktur_organisasi');
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
        // menam[ilkan halaman ubah data 
        $data = JajaranKami::where('id', $id)->first();
        $data_jabatan = MasterJabatan::all();

        return view($this->direktori . '.edit', compact('data','data_jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $profil = JajaranKami::findOrFail($id);

        if ($request->hasFile('gambar')) { //cek apakah ada request file
            $image = $request->file('gambar'); // jika ada ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // membuat nama file => waktu unix saat ini

            $destinationPath = public_path('/images/jajaran-kami'); // direktori file disimpan

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
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->id_jabatan_fk = $request->id_jabatan_fk;
        $profil->tagline = $request->tagline;
        $profil->tagline_en = $request->tagline_en;
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('struktur_organisasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = JajaranKami::findOrFail($id);

        $thumbnailName = $data->gambar; // ambil nama file yang akan dihapus
        $delete = $data->delete(); // hapus file

        if ($delete) {
            if ($thumbnailName) { // hapus file di direktori jika ada
                $thumbnailPath = public_path('/images/jajaran-kami/' . $thumbnailName);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }

            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('struktur_organisasi');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('struktur_organisasi');
        }
    }
    public function uploadImage(Request $request) // fungsi tidak digunakan 
    {
         // Validate the request
         $request->validate([
             'organization_structure_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
            // Handle the image upload
            if ($request->hasFile('organization_structure_image')) {
            $image = $request->file('organization_structure_image');
            $imageName = "struktur_organisasi" . '.' . $image->getClientOriginalExtension();
            // Directory path
            $directory = public_path('images/struktur_organisasi');

            // Remove all files in the directory
            $files = File::files($directory);
            foreach ($files as $file) {
                File::delete($file);
            }
            $image->move(public_path('images/struktur_organisasi'), $imageName);

            return back()->with('success', 'Image uploaded successfully')->with('image', $imageName);
        }

        return back()->with('error', 'Image upload failed');

    }
}
