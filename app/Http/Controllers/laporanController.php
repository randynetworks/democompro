<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class laporanController extends Controller
{
    // direktori blade
    protected $direktori = 'cms.menejemen_tentang_kami.laporan_keuangan';

    public function index()
    {
        // get data laporan bulanan
        $data = LaporanKeuangan::all();
        // get filter tahun dari model
        $filter_tahun = LaporanKeuangan::filter_tahun();

        return view($this->direktori . '.index', compact('data','filter_tahun'));
    }

    public function getDataJson(Request $request)
    {
        // json untuk datatable
        $data = LaporanKeuangan::select("id","bulan","file")->orderBy('bulan', 'asc');

        if ($request->date != '') {
            $tahun = $request->date;
            $data->where('bulan', 'like', $tahun . '-%');
        }
        
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_laporan(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_laporan(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('bulan', function ($data) {
                // menampilkan bulan dnegan format            
                $date = Carbon::createFromFormat('Y-m', $data->bulan);
                return $date->translatedFormat('F Y');
            })
            ->editColumn('file', function ($data) {   
                //menampilkan file dalam bentuk link             
                $filePath = asset("images/laporan/{$data->file}");
                return '<a href="' . $filePath . '" target="_blank">Lihat File</a>';
            })
            ->rawColumns(['opsi','file']) // render html di dalam datatable
            ->make();
    }

    public function chartLaporan(Request $request)
    {
        // json untuk chart area laporan keuangan bulanan -> skrang halaman tidak ditampilkan
        $filter = $request->date;
        $data = LaporanKeuangan::chart_laporan($filter);

        return response()->json($data);
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
        $profil = new LaporanKeuangan();

        if ($request->hasFile('file')) { // cek apakah ada request file
            $image = $request->file('file'); // jka ada ambil filnya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // membuat nama file -> stemple waktu unix saat ini  + ekstensi file asli

            $destinationPath = public_path('/images/laporan');    // direktori file disimpan         
            $image->move($destinationPath, $imageName); // menyimpan file di direktori

            $profil->file = $imageName; // menyimpan nama file di database
        }
        $profil->bulan = $request->bulan;
        // $profil->rata_rata = $request->rata_rata;
        $profil->save();

        session()->flash('sukses', 'Tambah Data Berhasil');
        return redirect()->route('laporan-keuangan-bulanan');
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
        $data = LaporanKeuangan::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // fungsi update data
        $profil = LaporanKeuangan::findOrFail($id);

        if ($request->hasFile('file')) { // dek apakah ada request file 
            $image = $request->file('file'); // jika ada ambil filenya
            $imageName = time().'.'.$image->getClientOriginalExtension(); // membuat nama file -> stemple waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/laporan'); // direktori file disimpan

            
            // Hapus file lama jika ada
            if ($profil->file) {
                $oldImagePath = $destinationPath . '/' . $profil->file;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            
            $image->move($destinationPath, $imageName); // simpan file ke direktori

            $profil->file = $imageName; // simpan nama file ke database
        }
        $profil->bulan = $request->bulan;
        // $profil->rata_rata = $request->rata_rata;
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('laporan-keuangan-bulanan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // fungsi hapus data 
        $data = LaporanKeuangan::findOrFail($id);
        $thumbnailName = $data->file; // ambil nama file yang akan di hapus
        $delete = $data->delete(); // hapus data 

        if ($delete) {
            if ($thumbnailName) { // cek nama file apakah ada di direktori
                $thumbnailPath = public_path('/images/laporan/' . $thumbnailName);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath); // hapus file lama jika ada
                }
            }

            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('laporan-keuangan-bulanan');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('laporan-keuangan-bulanan');
        }
    }

    public function cekBulan(Request $request)
    {
        // fungsi validasi inputan bulan

        $isAvailable = true; 
        // cek apakah inputan bulan sudah ada di database
        $user = LaporanKeuangan::where('bulan', $request->bulan)->first();

        if ($user) { // jika ada maka status akan jadi false 
            $isAvailable = false;
        }

        // ini untuk cek pada update data
        if ($request->id) {  
            $user = LaporanKeuangan::where('id', $request->id)->first();
            // jika request bulan dan di database sudah ada tapi id sama status menjadi true
            if ($user->bulan == $request->bulan) {
                $isAvailable = true;
            }
        }

        //kirim json ke blade
        return json_encode(array(
            'valid' => $isAvailable,
        ));
    }
}
