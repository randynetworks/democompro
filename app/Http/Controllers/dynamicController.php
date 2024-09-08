<?php

namespace App\Http\Controllers;

use App\Models\dynamic_menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class dynamicController extends Controller
{
    // direktori blade menu dinamis
    protected $direktori = 'cms.dynamic_menu';

    public function index()
    {
        $data = dynamic_menu::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        // json unttuk datatable menu dinamis
        $data = dynamic_menu::select("id","navbar","navbar_en","deskripsi","deskripsi_en","body")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_menu(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_menu(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('created_at',function ($data) {
                // menampilkan tanggal dengan format
                return Carbon::parse($data->created_at)->translatedFormat('d F Y H:i');
            })
            ->rawColumns(['opsi', 'created_at']) // render html didalam datatable 
            ->make();
    }

    public function create()
    {
        // menampilkan halaman create
        return view($this->direktori . '.create');
    }

    public function store(Request $request)
    {
        // fungsi tambah data 
        $profil = new dynamic_menu();
        $profil->navbar = $request->navbar;
        $profil->navbar_en = $request->navbar_en;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->body = $request->body;
        $profil->save();
        
        session()->flash('sukses', 'Tambah Data Berhasil');

        return redirect()->route('menu-dinamis');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        // menampilkan halaman ubah data
        $data = dynamic_menu::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        // fungsi update data 
        $profil = dynamic_menu::findOrFail($id);
        $profil->navbar = $request->navbar;
        $profil->navbar_en = $request->navbar_en;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->body = $request->body;
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('menu-dinamis');
    }

    public function destroy(string $id)
    {
        // hapus data
        $data = dynamic_menu::findOrFail($id);
        $delete = $data->delete();

        if ($delete) {
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('menu-dinamis');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('menu-dinamis');
        }
    }
}
