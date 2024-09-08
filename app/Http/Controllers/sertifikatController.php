<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class sertifikatController extends Controller
{
    // direktori blade
    protected $direktori = 'cms.menejemen_sertifikat';

    public function index()
    {
        // get data
        $data = Sertifikat::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        // json untuk datatable
        $data = Sertifikat::select("id","gambar","nama","kategori","waktu")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_sertifikat(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_sertifikat(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('gambar',function ($data) {
                // menampilkan gambar didalam datatable
                $alt = $data['gambar'];
                $img = '<img src="' . asset('images/sertifikat/' . $alt) . '" alt="' . $alt . '" max-height="174px" width="174px" onerror="this.style.display=\'none\'">';
                return $img;
            })
            ->editColumn('kategori',function ($data) {
                // membuat badge untuk kategori
                $alt = $data->kategori;
                if ($alt == 1) {
                    $kategori = '<div class="badge badge-light-success">Sertifikasi</div>';
                }else if ($alt == 2) {
                    $kategori = '<div class="badge badge-light-warning">Penghargaan</div>';
                }
                return $kategori;
            })
            ->editColumn('waktu',function ($data) {
                // menampilkan waktu dengn format
                return Carbon::parse($data->waktu)->translatedFormat('d F Y H:i');
            })
            ->rawColumns(['opsi', 'gambar',"kategori","waktu"]) // render html datatable
            ->make();
    }

    public function create()
    {
        // menampilkan halaman tambah data
        return view($this->direktori . '.create');
    }

    public function store(Request $request)
    {
        // fungsi tambah data
        $profil = new Sertifikat();

        if ($request->hasFile('gambar')) { // cek apakah ada request file
            $image = $request->file('gambar'); // jika ada maka ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // membuat nama file -> stempel waktu unix saat ini + ekestensi file asli

            $destinationPath = public_path('/images/sertifikat'); // direktori file disimpan
            $image->move($destinationPath, $imageName); // simpan file didirektori
  
            $profil->gambar = $imageName; // simpan nama file di database
        }
        $profil->nama = $request->nama;
        $profil->nama_en = $request->nama_en;
        $profil->kategori = $request->kategori;
        $profil->waktu = $request->waktu;
        $profil->save();
        
        session()->flash('sukses', 'Tambah Data Berhasil');

        return redirect()->route('sertifikat-prestasi');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        // menampilkan halaman ubah data
        $data = Sertifikat::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        // fungsi update data
        $profil = Sertifikat::findOrFail($id);

        if ($request->hasFile('gambar')) { // cek aapakah ada request file
            $image = $request->file('gambar'); // jika ada maka ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // membuat nama file -> stempel waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/sertifikat'); // direktori file disimpan
            // Hapus file lama jika ada
            if ($profil->gambar) {
                $oldImagePath = $destinationPath . '/' . $profil->gambar;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image->move($destinationPath, $imageName); // simpan file baru di direktori

            $profil->gambar = $imageName; // simpan nama file di database
        }
        $profil->nama = $request->nama;
        $profil->nama_en = $request->nama_en;
        $profil->kategori = $request->kategori;
        $profil->waktu = $request->waktu;
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('sertifikat-prestasi');
    }

    public function destroy(string $id)
    {
        //fungsi hapus data
        $data = Sertifikat::findOrFail($id);
        $thumbnailName = $data->gambar; // ambil nama file dari data yang akan dihapus
        $delete = $data->delete(); // hapus data

        if ($delete) {
            if ($thumbnailName) { // cek apakah ada file lama di direktori
                $thumbnailPath = public_path('/images/sertifikat/' . $thumbnailName);
                if (File::exists($thumbnailPath)) { // jika ada maka hapus
                    File::delete($thumbnailPath);
                }
            }
            // kirim alert jika proses sukses
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('sertifikat-prestasi');
        }else{
            //kirim alert erpor jika proses gagal
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('sertifikat-prestasi');
        }
    }
}
