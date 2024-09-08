<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class laporanController extends Controller
{
    protected $direktori = 'cms.menejemen_tentang_kami.laporan_keuangan';

    public function index()
    {
        $data = LaporanKeuangan::all();
        $filter_tahun = LaporanKeuangan::filter_tahun();

        return view($this->direktori . '.index', compact('data','filter_tahun'));
    }

    public function getDataJson(Request $request)
    {
        $data = LaporanKeuangan::select("id","bulan","rata_rata","file")->orderBy('bulan', 'asc');

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
                $date = Carbon::createFromFormat('Y-m', $data->bulan);
                return $date->translatedFormat('F Y');
            })
            ->editColumn('file', function ($data) {                
                $filePath = asset("images/laporan/{$data->file}");
                return '<a href="' . $filePath . '" target="_blank">Lihat File</a>';
            })
            ->rawColumns(['opsi','file'])
            ->make();
    }

    public function chartLaporan(Request $request)
    {
        $filter = $request->date;
        $data = LaporanKeuangan::chart_laporan($filter);

        return response()->json($data);
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
        $profil = new LaporanKeuangan();

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/laporan');            
            $image->move($destinationPath, $imageName);

            $profil->file = $imageName;
        }
        $profil->bulan = $request->bulan;
        $profil->rata_rata = $request->rata_rata;
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
        $data = LaporanKeuangan::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $profil = LaporanKeuangan::findOrFail($id);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/laporan');

            
            // Hapus file lama jika ada
            if ($profil->file) {
                $oldImagePath = $destinationPath . '/' . $profil->file;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            
            $image->move($destinationPath, $imageName);

            $profil->file = $imageName;
        }
        $profil->bulan = $request->bulan;
        $profil->rata_rata = $request->rata_rata;
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('laporan-keuangan-bulanan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = LaporanKeuangan::findOrFail($id);
        $thumbnailName = $data->file;
        $delete = $data->delete();

        if ($delete) {
            if ($thumbnailName) {
                $thumbnailPath = public_path('/images/laporan/' . $thumbnailName);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
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
        $isAvailable = true;

        $user = LaporanKeuangan::where('bulan', $request->bulan)->first();

        if ($user) {
            $isAvailable = false;
        }

        if ($request->id) {
            $user = LaporanKeuangan::where('id', $request->id)->first();

            if ($user->bulan == $request->bulan) {
                $isAvailable = true;
            }
        }

        return json_encode(array(
            'valid' => $isAvailable,
        ));
    }
}
