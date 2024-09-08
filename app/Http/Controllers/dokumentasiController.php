<?php

namespace App\Http\Controllers;

use App\Models\Documentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class dokumentasiController extends Controller
{
    // direktori blade untuk cms dokumentasi
    protected $direktori = 'cms.menejemen_beranda.kegiatan.dokumentasi';

    public function index()
    {
        $data = Documentasi::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        // json untuk datatable dokumentasi
        $data = Documentasi::select("id","gambar","text","kategori","waktu")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_dokumentasi(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_dokumentasi(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('gambar',function ($data) {
                // menampilkan gambar ke datatable
                $alt = $data['gambar'];
                $img = '<img src="' . asset('images/dokumentasi/' . $alt) . '" alt="' . $alt . '" max-height="174px" width="174px" onerror="this.style.display=\'none\'">';
                return $img;
            })                                         
            ->addColumn('text', function($data) {
                // str limit untuk membatasi string yang terlalu panjang
                return strlen($data->text) > 20 ? substr($data->text, 0, 50) . '...' : $data->text;
            })
            // ->editColumn('kategori',function ($data) {
            //     // badge kategori
            //     $alt = $data->kategori;
            //     if ($alt == 1) {
            //         $kategori = '<div class="badge badge-light-success">Sosial</div>';
            //     }else if ($alt == 2) {
            //         $kategori = '<div class="badge badge-light-warning">Acara</div>';
            //     }else{
            //         return "-";
            //     }
            //     return $kategori;
            // })   
            ->editColumn('waktu',function ($data) {
                return Carbon::parse($data->waktu)->translatedFormat('d F Y H:i');
            })   
            ->rawColumns(['opsi', 'gambar','waktu','text']) //render html yang ada di datatable
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
        $profil = new Documentasi();

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension(); // mmebuat nama file -> waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/dokumentasi'); // direktori file akan disimpan
            $image->move($destinationPath, $imageName); 

            $profil->gambar = $imageName;
        }
        $profil->text = $request->text;
        $profil->text_en = $request->text_en;
        // $profil->kategori = $request->kategori;
        $profil->waktu = $request->waktu;
        $profil->save();
        
        session()->flash('sukses', 'Tambah Data Berhasil');
        return redirect()->route('dokumentasi');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // menampilkan halaman detail
        $dokumentasi = Documentasi::find($id);
        return view('landing.dokumentasiDetail', ['value' => $dokumentasi]);
    }

    public function download($id)
    {
        // download file dokumentasi
        $data = Documentasi::find($id)?->gambar;
        $filename = "Dokumentasi";
        $path = "images/dokumentasi";
        $file = public_path($path . "/" . $data);
        return response()->download($file, $filename);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // menampilkan halaman ubah data
        $data = Documentasi::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // fungsi update data di database
        $profil = Documentasi::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension(); // mmebuat nama file -> waktu saat ini + ekstensi file asli

            $destinationPath = public_path('/images/dokumentasi'); //direktori file akan disimpan

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
        $profil->text = $request->text;
        $profil->text_en = $request->text_en;
        // $profil->kategori = $request->kategori;
        $profil->waktu = $request->waktu;
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('dokumentasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Documentasi::findOrFail($id);

        // ambil nama file yang akan dihapus
        $thumbnailName = $data->gambar;
        // hapus data
        $delete = $data->delete();

        if ($delete) {
            if ($thumbnailName) { // hapus file di direktori jika ada
                $thumbnailPath = public_path('/images/dokumentasi/' . $thumbnailName);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }

            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('dokumentasi');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('dokumentasi');
        }
    }
}
