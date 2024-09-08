<?php

namespace App\Http\Controllers;

use App\Models\nilai;
use App\Models\nilaiByGambar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class nilaiController extends Controller
{
    protected $direktori = 'cms.menejemen_beranda.nilai';

    public function index()
    {
        $data = nilai::all();
        $data_by_gambar = nilaiByGambar::first();
        $status_nilai = User::first();
        return view($this->direktori . '.index', compact('data','data_by_gambar','status_nilai'));
    }

    public function getDataJson()
    {
        $data = nilai::select("id","text","icon","gambar")->orderby('created_at', 'asc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_nilai(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_nilai(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('gambar',function ($data) {
                $alt = $data['gambar'];
                $img = '<img src="' . asset('images/nilai_by_gambar/' . $alt) . '" alt="' . $alt . '" onerror="this.style.display=\'none\'" style=" width: 26px; height: 41px">';
                return $img;
            })                     
            ->addColumn('text', function($data) {
                return strlen($data->text) > 20 ? substr($data->text, 0, 50) . '...' : $data->text;
            })
            ->rawColumns(['opsi','text','gambar'])
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

        $data = new nilai();
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/nilai_by_gambar');
            $image->move($destinationPath, $imageName);

            $data->gambar = $imageName;
        }
        // $data->icon = $request->icon;
        $data->text = $request->text;
        $data->text_en = $request->text_en;
        $data->deskripsi = $request->deskripsi;
        $data->deskripsi_en = $request->deskripsi_en;
        $data->save();
        
        session()->flash('sukses', 'Tambah Data Berhasil');

        return redirect()->route('manajemen-nilai');
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
        $data = nilai::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = nilai::findOrFail($id);
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/nilai_by_gambar');
            // Hapus file lama jika ada
            if ($data->gambar) {
                $oldImagePath = $destinationPath . '/' . $data->gambar;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image->move($destinationPath, $imageName);

            $data->gambar = $imageName;
        }
        // $data->icon = $request->icon;
        $data->text = $request->text;
        $data->text_en = $request->text_en;
        $data->deskripsi = $request->deskripsi;
        $data->deskripsi_en = $request->deskripsi_en;
        $data->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('manajemen-nilai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = nilai::findOrFail($id);
        $gambar = $data->gambar;
        $delete = $data->delete();

        if ($delete) {
            if ($gambar) {
                $thumbnailPath = public_path('/images/nilai_by_gambar/' . $gambar);
                if (File::exists($thumbnailPath)) {
                    File::delete($thumbnailPath);
                }
            }
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('manajemen-nilai');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('manajemen-nilai');
        }
    }


    // ---------------------------- inputan gambar --------------------------
    protected $direktori_gambar = 'cms.menejemen_beranda.nilai_by_gambar';

    public function index_gambar()
    {
        $data = nilaiByGambar::first();
        return view($this->direktori_gambar . '.index', compact('data'));
    }
    
    public function update_gambar(Request $request, string $id)
    {
        $data = nilaiByGambar::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/nilai_by_gambar');
            // Hapus file lama jika ada
            if ($data->gambar) {
                $oldImagePath = $destinationPath . '/' . $data->gambar;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image->move($destinationPath, $imageName);

            $data->gambar = $imageName;
        }
        $data->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('manajemen-nilai');
    }
}
