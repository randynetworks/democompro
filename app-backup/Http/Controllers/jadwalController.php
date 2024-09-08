<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class jadwalController extends Controller
{
    protected $direktori = 'cms.menejemen_beranda.kegiatan.jadwal';

    public function index()
    {
        $data = Jadwal::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        $data = Jadwal::select("id","headline","deskripsi","start_date","end_date")->orderby('start_date', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_jadwal(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_jadwal(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })   
            ->editColumn('start_date',function ($data) {
                return Carbon::parse($data->start_date)->translatedFormat('d F Y H:i');
            })   
            ->editColumn('end_date',function ($data) {
                return Carbon::parse($data->end_date)->translatedFormat('d F Y H:i');
            })                               
            ->addColumn('deskripsi', function($data) {
                return strlen($data->deskripsi) > 20 ? substr($data->deskripsi, 0, 50) . '...' : $data->deskripsi;
            })
            ->rawColumns(['opsi', 'start_date','end_date','deskripsi'])
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
        $profil = new Jadwal();

        $profil->headline = $request->headline;
        $profil->headline_en = $request->headline_en;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->start_date = $request->start_date;
        $profil->end_date = $request->end_date;
        $profil->save();
        
        session()->flash('sukses', 'Tambah Data Berhasil');
        return redirect()->route('jadwal');
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
        $data = Jadwal::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $profil = Jadwal::findOrFail($id);

        $profil->headline = $request->headline;
        $profil->headline_en = $request->headline_en;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->start_date = $request->start_date;
        $profil->end_date = $request->end_date;
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('jadwal');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Jadwal::where('id', $id)->delete();

        if($delete) {
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('jadwal');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('jadwal');
        }
    }
}
