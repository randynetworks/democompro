<?php

namespace App\Http\Controllers;

use App\Helpers\TranslateTextHelper;
use App\Models\Landing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class landingController extends Controller
{
    protected $direktori = 'cms.menejemen_beranda.landing';

    public function index()
    {
        $data = Landing::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        $data = Landing::select("id","gambar","nama_perusahaan","motto","deskripsi")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_landing(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_landing(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('gambar',function ($data) {
                $alt = $data['gambar'];
                // $img = '<img src="/images/landing/' . $alt . '" alt="$alt" max-height="174px" width="174px">';
                $img = '<img src="' . asset('images/landing/' . $alt) . '" alt="' . $alt . '" max-height="174px" width="174px" onerror="this.style.display=\'none\'">';
                return $img;
            })            
            ->addColumn('deskripsi', function($data) {
                return strlen($data->deskripsi) > 20 ? substr($data->deskripsi, 0, 50) . '...' : $data->deskripsi;
            })         
            ->rawColumns(['opsi', 'gambar','deskripsi'])
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
        $profil = new Landing();

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/landing');
            $image->move($destinationPath, $imageName);

            $profil->gambar = $imageName;
        }
        $profil->nama_perusahaan = $request->nama_perusahaan;
        $profil->motto = $request->motto;
        $profil->motto_en = $request->motto_en;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->save();

        session()->flash('sukses', 'Tambah Data Berhasil');
        return redirect()->route('manajemen-landing-page');
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
        $data = Landing::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $profil = Landing::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/landing');
            
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
        $profil->nama_perusahaan = $request->nama_perusahaan;
        $profil->motto = $request->motto;
        $profil->motto_en = $request->motto_en;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('manajemen-landing-page');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Landing::findOrFail($id);
        $thumbnailName = $data->gambar;
        $delete = $data->delete();

        if ($delete) {
            if ($thumbnailName) {
                $thumbnailPath = public_path('/images/landing/' . $thumbnailName);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('manajemen-landing-page');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('manajemen-landing-page');
        }
    }

    public function translate(Request $request)
    {
        TranslateTextHelper::setSource('id')->setTarget('en');

        $translatedText = TranslateTextHelper::translate($request->text);

        return response()->json(['text' => $translatedText]);
    }

    public function update_nilai_status(Request $request)
    {
        $data = User::first();
        $data->status_nilai = $request->status_nilai;
        $data->save();
        
        return response()->json(['message' => 'Status updated successfully']);
    }

    public function update_nilai_calendar(Request $request)
    {
        $data = User::first();
        $data->status_calendar = $request->status_calendar;
        $data->save();
        
        return response()->json(['message' => 'Status updated successfully']);
    }
}
