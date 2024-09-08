<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class sertifikatController extends Controller
{
    protected $direktori = 'cms.menejemen_sertifikat';

    public function index()
    {
        $data = Sertifikat::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
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
                $alt = $data['gambar'];
                // $img = '<img src="/images/sertifikat/' . $alt . '" alt="$alt" height="174px" width="174px">';
                $img = '<img src="' . asset('images/sertifikat/' . $alt) . '" alt="' . $alt . '" max-height="174px" width="174px" onerror="this.style.display=\'none\'">';
                return $img;
            })
            ->editColumn('kategori',function ($data) {
                $alt = $data->kategori;
                if ($alt == 1) {
                    $kategori = '<div class="badge badge-light-success">Sertifikasi</div>';
                }else if ($alt == 2) {
                    $kategori = '<div class="badge badge-light-warning">Penghargaan</div>';
                }
                return $kategori;
            })
            ->editColumn('waktu',function ($data) {
                return Carbon::parse($data->waktu)->translatedFormat('d F Y H:i');
            })
            ->rawColumns(['opsi', 'gambar',"kategori","waktu"])
            ->make();
    }

    public function create()
    {
        return view($this->direktori . '.create');
    }

    public function store(Request $request)
    {
        $profil = new Sertifikat();

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/sertifikat');
            $image->move($destinationPath, $imageName);

            $profil->gambar = $imageName;
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
        $data = Sertifikat::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {

        $profil = Sertifikat::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/sertifikat');
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
        $profil->nama_en = $request->nama_en;
        $profil->kategori = $request->kategori;
        $profil->waktu = $request->waktu;
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('sertifikat-prestasi');
    }

    public function destroy(string $id)
    {
        $data = Sertifikat::findOrFail($id);
        $thumbnailName = $data->gambar;
        $delete = $data->delete();

        if ($delete) {
            if ($thumbnailName) {
                $thumbnailPath = public_path('/images/sertifikat/' . $thumbnailName);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('sertifikat-prestasi');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('sertifikat-prestasi');
        }
    }
}
