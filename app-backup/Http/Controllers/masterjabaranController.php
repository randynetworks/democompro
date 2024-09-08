<?php

namespace App\Http\Controllers;

use App\Models\MasterJabatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class masterjabaranController extends Controller
{
    protected $direktori = 'cms.master.jabatan';

    public function index()
    {
        $data = MasterJabatan::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        $data = MasterJabatan::select("id","jabatan","level","status_tampil")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_jabatan(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_jabatan(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('status_tampil',function ($data) {
                return '<input type="checkbox" class="status-checkbox" data-id="'. $data->id .'" '. ($data->status_tampil ? 'checked' : '') .'>';
            })  
            ->rawColumns(['opsi','status_tampil'])
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
        $profil = new MasterJabatan();

        $profil->jabatan = $request->jabatan;
        $profil->jabatan_en = $request->jabatan_en;
        $profil->level = $request->level;
        $profil->save();

        session()->flash('sukses', 'Tambah Data Berhasil');

        return redirect()->route('master-jabatan');
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
        $data = MasterJabatan::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $profil = MasterJabatan::findOrFail($id);

        $profil->jabatan = $request->jabatan;
        $profil->jabatan_en = $request->jabatan_en;
        $profil->level = $request->level;
        $profil->save();

        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('master-jabatan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = MasterJabatan::where('id', $id)->delete();

        if($delete) {
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('master-jabatan');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('master-jabatan');
        }
    }

    public function cekJabatan(Request $request)
    {
        $isAvailable = true;

        $user = MasterJabatan::where('jabatan', $request->jabatan)->first();

        if ($user) {
            $isAvailable = false;
        }

        if ($request->id) {
            $user = MasterJabatan::where('id', $request->id)->first();

            if ($user->jabatan == $request->jabatan) {
                $isAvailable = true;
            }
        }

        return json_encode(array(
            'valid' => $isAvailable,
        ));
    }

    public function cekJabatanEn(Request $request)
    {
        $isAvailable = true;

        $user = MasterJabatan::where('jabatan_en', $request->jabatan_en)->first();

        if ($user) {
            $isAvailable = false;
        }

        if ($request->id) {
            $user = MasterJabatan::where('id', $request->id)->first();

            if ($user->jabatan_en == $request->jabatan_en) {
                $isAvailable = true;
            }
        }

        return json_encode(array(
            'valid' => $isAvailable,
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $profil = MasterJabatan::findOrFail($id);
        $profil->status_tampil = $request->status_tampil;
        $profil->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
