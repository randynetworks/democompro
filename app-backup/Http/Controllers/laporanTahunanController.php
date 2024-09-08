<?php

namespace App\Http\Controllers;

use App\Models\laporanTahunan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class laporanTahunanController extends Controller
{
    protected $direktori = 'cms.menejemen_tentang_kami.laporan_keuangan_tahunan';

    public function index()
    {
        $data = laporanTahunan::all();
        $filter_tahun = laporanTahunan::filter_tahun();

        return view($this->direktori . '.index', compact('data','filter_tahun'));
    }

    public function getDataJson(Request $request)
    {
        $data = laporanTahunan::select("id","tahun","rata_rata","file")->orderBy('tahun', 'asc');

        // if ($request->date != '') {
        //     $tahun = $request->date;
        //     $data->where('tahun', 'like', $tahun . '-%');
        // }
        
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_laporan(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_laporan(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('file', function ($data) {                
                $filePath = asset("images/laporan-tahunan/{$data->file}");
                return '<a href="' . $filePath . '" target="_blank">Lihat File</a>';
            })
            ->rawColumns(['opsi','file'])
            ->make();
    }

    public function chartLaporan(Request $request)
    {
        // $filter = $request->date;
        $data = laporanTahunan::chart_laporan();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $years = range(1900, strftime("%Y", time()));
        return view($this->direktori . '.create', compact('years'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {            
        $profil = new laporanTahunan();

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/laporan-tahunan');            
            $image->move($destinationPath, $imageName);

            $profil->file = $imageName;
        }
        $profil->tahun = $request->tahun;
        $profil->rata_rata = $request->rata_rata;
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
        $data = laporanTahunan::where('id', $id)->first();
        $years = range(1900, strftime("%Y", time()));

        return view($this->direktori . '.edit', compact('data','years'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $profil = laporanTahunan::findOrFail($id);

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/laporan-tahunan');

            
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
        $profil->tahun = $request->tahun;
        $profil->rata_rata = $request->rata_rata;
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('laporan-keuangan-tahunan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = laporanTahunan::findOrFail($id);
        $thumbnailName = $data->file;
        $delete = $data->delete();

        if ($delete) {
            if ($thumbnailName) {
                $thumbnailPath = public_path('/images/laporan-tahunan/' . $thumbnailName);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
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
        $isAvailable = true;

        $user = laporanTahunan::where('tahun', $request->tahun)->first();

        if ($user) {
            $isAvailable = false;
        }

        if ($request->id) {
            $user = laporanTahunan::where('id', $request->id)->first();

            if ($user->tahun == $request->tahun) {
                $isAvailable = true;
            }
        }

        return json_encode(array(
            'valid' => $isAvailable,
        ));
    }
}
