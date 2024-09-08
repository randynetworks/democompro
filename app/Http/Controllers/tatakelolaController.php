<?php

namespace App\Http\Controllers;

use App\Models\FileTataKelola;
use App\Models\TataKelola;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class tatakelolaController extends Controller
{ 
    // direktori blade --> SKrang halaman tidak ditampilkan
    protected $direktori = 'cms.menejemen_beranda.tata_kelola';

    public function index()
    {
        $data = TataKelola::all();
        $file = FileTataKelola::first();
        return view($this->direktori . '.index', compact('data', 'file'));
    }

    public function getDataJson()
    {
        $data = TataKelola::select("id","nama","email","kategori","waktu")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('kategori',function ($data) {
                if ($data->kategori == 'tatakelola') {
                    $kategori = '<div class="badge badge-light-success">Tata Kelola</div>';
                }else if ($data->kategori == 'resiko') {
                    $kategori = '<div class="badge badge-light-warning">Risiko & Kepatuhan</div>';
                }
                return $kategori;
            })   
            ->editColumn('waktu',function ($data) {
                return Carbon::parse($data->waktu)->translatedFormat('d F Y H:i');
            })         
            ->rawColumns(['kategori'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    

        $profil = new TataKelola();

        $profil->nama = $request->nama;
        $profil->email = $request->email;
        $profil->kategori = $request->kategori;
        $profil->waktu = $request->waktu;
        $profil->save();

        // return redirect()->route('manajemen-ucapan');
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}