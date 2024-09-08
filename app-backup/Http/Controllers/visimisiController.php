<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class visimisiController extends Controller
{
    protected $direktori = 'cms.menejemen_perusahaan.visi_misi';

    public function index()
    {
        // $data = VisiMisi::all();
        // return view($this->direktori . '.index', compact('data'));
        
        $data = VisiMisi::first();

        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        $data = VisiMisi::select("id","visi","misi")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_profil(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                return $opsi;
            })
            ->addColumn('deskripsi', function($data) {
                return strlen($data->deskripsi) > 20 ? substr($data->deskripsi, 0, 50) . '...' : $data->deskripsi;
            })
            ->rawColumns(['opsi', 'deskripsi'])
            ->make();
    }

    public function edit(string $id)
    {
        $data = VisiMisi::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profil = VisiMisi::findOrFail($id);

        $profil->visi = $request->visi;
        $profil->misi = $request->misi;
        $profil->visi_en = $request->visi_en ;
        $profil->misi_en  = $request->misi_en ;
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('visi-misi');
    }
}
