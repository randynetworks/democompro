<?php

namespace App\Http\Controllers;

use App\Models\headerPicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class headerPictureController extends Controller
{
    // direktori blade 
    protected $direktori = 'cms.menejemen_image_header';

    public function index()
    {
        $data = headerPicture::all();
        return view($this->direktori . '.index', compact('data'));
    }
    
    public function getDataJson()
    {
        // json untuk datatable 
        $data = headerPicture::select("id","kategori","gambar")->orderby('id', 'asc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('gambar',function ($data) {
                // menampilkan dgambar didalam datatable
                $alt = $data['gambar'];
                $img = '<img src="' . asset('images/image-header/' . $alt) . '" alt="' . $alt . '" max-height="174px" width="174px" onerror="this.style.display=\'none\'">';
                return $img;
            })
            ->rawColumns(['opsi', 'gambar']) //render html di dalam datatable
            ->make();
    }

    public function edit(string $id)
    {
        $data = headerPicture::where('id', $id)->first();
        return view($this->direktori . '.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = headerPicture::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension(); // mmebuat nama file -> waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/image-header'); // direktori file disimpan
            
            if ($data->gambar) { // hapus file lama jika ada
                $oldImagePath = $destinationPath . '/' . $data->file;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image->move($destinationPath, $imageName);
            $data->gambar = $imageName;
        }
        $data->save();

        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('manajemen-image-header');
    }
}
