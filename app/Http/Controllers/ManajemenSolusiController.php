<?php

namespace App\Http\Controllers;

use App\Helpers\TranslateTextHelper;
use App\Models\Solusi;
use App\Models\SolusiDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ManajemenSolusiController extends Controller
{
    // direktori blade
    protected $direktori = 'cms.menejemen_solusi';

    public function index()
    {
        // get all data solusi
        $data = Solusi::all();

        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson(Request $request)
    {
        // Select data from 'solusis' and 'solusi_details' tables joined on 'solusi_id'
        $data = Solusi::join('solusi_details', 'solusis.id', '=', 'solusi_details.solusi_id')
                ->select('solusis.id as id', 'solusi_details.id as solusi_detail_id', 'solusis.kategori', 'solusis.kategori_en', 'solusi_details.judul', 'solusi_details.judul_en', 'solusi_details.deskripsi', 'solusi_details.deskripsi_en')
                ->orderBy('solusis.kategori', 'asc');
        // Use DataTables to format the data for JSON response
        return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('opsi', function ($data) {
                    $opsi = '';
                    $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_solusi(' . $data->solusi_detail_id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                    $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_solusi(' . $data->solusi_detail_id . ');"><i class="bi bi-trash fs-4"></i></button>';
                    return $opsi;
                })
                ->rawColumns(['opsi'])
                ->make();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // menampilkan halmaan tmbah data
        $data_ktg = Solusi::all();
        return view($this->direktori . '.create', compact('data_ktg'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // fungsi tambah data 
        $solusiDetail = new SolusiDetail();

        // replace css bawaan ckeditor
        $deskripsi = Str::replace('style="width:100%"', '',$request->deskripsi);
        $deskripsi_en = Str::replace('style="width:100%"', '', $request->deskripsi_en);
       

        // Assign values directly
        $solusiDetail->solusi_id = $request->kategori; // Assign the ID of the newly saved Solusi
        $solusiDetail->judul = $request->judul;
        $solusiDetail->judul_en = $request->judul_en;
        $solusiDetail->deskripsi = $deskripsi;
        $solusiDetail->deskripsi_en = $deskripsi_en;
        $solusiDetail->save();

        session()->flash('sukses', 'Tambah Data Berhasil');

        // Redirect to the route named 'manajemen-solusi'
        return redirect()->route('manajemen-solusi');
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
        // solusi detail
        $dataDetail = SolusiDetail::where('id',$id)->get()->first();
        // solusi master ketegori
        $data = Solusi::where('id', $dataDetail->solusi_id)->get()->first();
        // kirim data ke blade
        return view($this->direktori . '.edit', compact('data','dataDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // fungsi update data
        $body = $request->all();
        $solusiDetail = SolusiDetail::findOrFail($id);
    
        // replace css bawaan ckeditor
        $deskripsi = Str::replace('style="width:100%"', '', $body["deskripsi"]);
        $deskripsi_en = Str::replace('style="width:100%"', '', $body["deskripsi_en"]);
       
        $solusiDetail->solusi_id = $body["kategori"];
        $solusiDetail->judul = $body["judul"];
        $solusiDetail->judul_en = $body["judul_en"];
        $solusiDetail->deskripsi = $deskripsi; 
        $solusiDetail->deskripsi_en = $deskripsi_en; 
        $solusiDetail->save();

        session()->flash('sukses', 'Update Data Berhasil');
    
        // Redirect ke route dengan nama 'manajemen-solusi'
        return redirect()->route('manajemen-solusi');
    }

    public function destroy(string $id)
    {
        // Find the Solusi record by its ID
        $solusiDetail = SolusiDetail::findOrFail($id);
        $solusiDetail->delete();

        // Flash success or failure message to session based on delete operation
        session()->flash('sukses', 'Hapus Data Berhasil');
        session()->flash('gagal', 'Hapus Data Gagal');

        // Redirect to the route named 'manajemen-solusi'
        return redirect()->route('manajemen-solusi');
    }

    public function translate($r)
    {
        // fungsi translate kata

        // memanggil helper dan set dari bahasa indonesia dan akan di translate ke bahasa inggris
        TranslateTextHelper::setSource('id')->setTarget('en');
        //simpan hasil translate 
        $translatedText = TranslateTextHelper::translate($r);

        return $translatedText;
    }
}
