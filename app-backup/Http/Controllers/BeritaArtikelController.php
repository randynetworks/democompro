<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BeritaArtikel;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class BeritaArtikelController extends Controller
{

    protected $direktori = 'cms.menejemen_berita.berita_artikel';

    public function index()
    {
        $data_berita_artikel = BeritaArtikel::all();
        $active = 'berita-artikel';
        return view($this->direktori . '.index', compact('data_berita_artikel', 'active'));
    }

    public function getDataJson()
    {
        $data = BeritaArtikel::select("id","thumbnail","judul","isi_berita","waktu","kategori")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_berita(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_berita(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('thumbnail',function ($data) {
                $alt = $data['thumbnail'];
                $img = '<img src="' . asset('images/berita_artikel/' . $alt) . '" alt="' . $alt . '" max-height="174px" width="174px" onerror="this.style.display=\'none\'">';

                return $img;
            })
            // ->addColumn('judul', function($data) {
            //     return strlen($data->judul) > 20 ? substr($data->judul, 0, 35) . '...' : $data->judul;
            // }) 
            ->editColumn('kategori',function ($data) {
                $alt = $data->kategori;
                if ($alt == 1) {
                    $kategori = '<div class="badge badge-light-success">Berita</div>';
                }else if ($alt == 2) {
                    $kategori = '<div class="badge badge-light-warning">Artikel</div>';
                }
                return $kategori;
            })
            ->editColumn('waktu',function ($data) {
                return Carbon::parse($data->waktu)->translatedFormat('d F Y H:i');
            })
            ->rawColumns(['opsi', 'thumbnail','waktu','kategori'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->direktori . '.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $profil = new BeritaArtikel();

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/berita_artikel');
            $image->move($destinationPath, $imageName);

            $profil->thumbnail = $imageName;
        }
        $profil->judul = $request->judul;
        $profil->judul_en = $request->judul_en;
        $profil->isi_berita = $request->isi_berita;
        $profil->isi_berita_en = $request->isi_berita_en;
        $profil->waktu = $request->waktu;
        $profil->kategori = $request->kategori;
        $profil->slug = Str::slug($request->judul. '-' . $profil->id);
        $profil->save();

        session()->flash('sukses', 'Tambah Data Berhasil');

        return redirect()->route('berita-artikel');
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
        $data = BeritaArtikel::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $profil = BeritaArtikel::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/berita_artikel');

            // Hapus file lama jika ada
            if ($profil->thumbnail) {
                $oldImagePath = $destinationPath . '/' . $profil->thumbnail;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image->move($destinationPath, $imageName);

            $profil->thumbnail = $imageName;
        }
        $profil->judul = $request->judul;
        $profil->judul_en = $request->judul_en;
        $profil->isi_berita = $request->isi_berita;
        $profil->isi_berita_en = $request->isi_berita_en;
        $profil->waktu = $request->waktu;
        $profil->kategori = $request->kategori;
        $profil->slug = Str::slug($request->judul. '-' . $profil->id);
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('berita-artikel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $beritaArtikel = BeritaArtikel::findOrFail($id);

        // Simpan nama file gambar sebelum menghapus data
        $thumbnailName = $beritaArtikel->thumbnail;

        // Hapus data BeritaArtikel dari basis data
        $delete = $beritaArtikel->delete();

        if ($delete) {
            // Jika data berhasil dihapus, hapus juga file gambar terkait jika ada
            if ($thumbnailName) {
                $thumbnailPath = public_path('/images/berita_artikel/' . $thumbnailName);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('berita-artikel');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('berita-artikel');
        }
    }

    public function kunjungan_berita(Request $request, string $id)
    {
        $profil = BeritaArtikel::findOrFail($id);
        $profil->total_kunjung += 1;
        $profil->save();
    }
}
