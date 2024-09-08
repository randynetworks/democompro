<?php

namespace App\Http\Controllers;

use App\Models\laporanTahunan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class laporanTahunanController extends Controller
{
    // direktori blade
    protected $direktori = 'cms.menejemen_tentang_kami.laporan_keuangan_tahunan';

    public function index()
    {
        // get data laporan tahunan
        $data = laporanTahunan::all();
        // get filter tahun dari model
        $filter_tahun = laporanTahunan::filter_tahun();

        return view($this->direktori . '.index', compact('data','filter_tahun'));
    }

    public function getDataJson(Request $request)
    {
        // json untuk datatable
        $data = laporanTahunan::select("id","tahun","file")->orderBy('tahun', 'asc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_laporan(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_laporan(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('file', function ($data) {
                //menampilkan laporan tahunan ddengan link                
                $filePath = asset("images/laporan-tahunan/{$data->file}");
                return '<a href="' . $filePath . '" target="_blank">Lihat File</a>';
            })
            ->rawColumns(['opsi','file'])
            ->make();
    }

    public function chartLaporan(Request $request)
    {
        // json untuk chart area laporan keuangan tahunan -> skrang halaman tidak ditampilkan
        $data = laporanTahunan::chart_laporan();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  menampilkan halaman tambah data
        // membuat select option tahun
        $years = range(1900, strftime("%Y", time()));
        return view($this->direktori . '.create', compact('years'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {            
        // fungsi tmbah data
        $profil = new laporanTahunan();

        if ($request->hasFile('file')) { // cek apakah add request file
            $image = $request->file('file'); // jika ada maka ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // membuat nama file ->  stempel waktu unix saat ini + ektensi file asli

            $destinationPath = public_path('/images/laporan-tahunan'); // direktori file disinpan            
            $image->move($destinationPath, $imageName); // menyimpan file ke direktori

            $profil->file = $imageName; // menyimpan nama file ke database
        }
        $profil->tahun = $request->tahun;
        // $profil->rata_rata = $request->rata_rata;
        $profil->save();

        session()->flash('sukses', 'Tambah Data Berhasil');
        return redirect()->route('laporan-keuangan-tahunan');
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
        // menampilkan halaman ubah data
        $data = laporanTahunan::where('id', $id)->first();
        $years = range(1900, strftime("%Y", time()));

        return view($this->direktori . '.edit', compact('data','years'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // fungsi update data
        $profil = laporanTahunan::findOrFail($id);

        if ($request->hasFile('file')) { // cek apakah ada request file
            $image = $request->file('file'); // jika ada ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // membuat nama file -> stempel waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/laporan-tahunan'); // direktori file disimpan
            
            // Hapus file lama jika ada
            if ($profil->file) {
                $oldImagePath = $destinationPath . '/' . $profil->file;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            
            $image->move($destinationPath, $imageName); // menyimpan file ke direktori

            $profil->file = $imageName; // menyimpan nama file ke database
        }
        $profil->tahun = $request->tahun;
        // $profil->rata_rata = $request->rata_rata;
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('laporan-keuangan-tahunan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // fungsi hapus data
        $data = laporanTahunan::findOrFail($id);
        $thumbnailName = $data->file; // ambil nama file yang akan di hapus
        $delete = $data->delete();

        if ($delete) {
            if ($thumbnailName) {  // cek apakah nama file ada di direktori
                $thumbnailPath = public_path('/images/laporan-tahunan/' . $thumbnailName);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath); // hapus file lama jika ada
                }
            }

            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('laporan-keuangan-tahunan');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('laporan-keuangan-tahunan');
        }
    }

    public function cekBulan(Request $request)
    {
        // fungsi validasi inputan tahun 
        $isAvailable = true;

        // cek apakah inputan tahun sudah ada di database 
        $user = laporanTahunan::where('tahun', $request->tahun)->first();

        if ($user) { // jika ada status diubah jadi false
            $isAvailable = false;
        }

        //  ini untuk cek saat update data
        if ($request->id) {
            $user = laporanTahunan::where('id', $request->id)->first();
            // jika request tahun dan di database sudah ada tapi id sama status menjadi true
            if ($user->tahun == $request->tahun) {
                $isAvailable = true;
            }
        }

        // kirim json ke blade
        return json_encode(array(
            'valid' => $isAvailable,
        ));
    }
}
