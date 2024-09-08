<?php

namespace App\Http\Controllers;

use App\Models\TagMeta;
use Illuminate\Http\Request;

class TagMetaController extends Controller
{
    //direktori blade
    protected $direktori = 'cms.tag_meta';

    public function index()
    {        
        // get data
        $data = TagMeta::first();
        return view($this->direktori . '.index', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        // fungsi update
        $data = TagMeta::findOrFail($id);

        $data->title = $request->title;
        $data->deskripsi = $request->deskripsi;
        $data->keyword = $request->keyword;
        $data->save();
        
        session()->flash('sukses', 'Update Data Berhasil');
        return redirect()->route('manajemen-meta');
    }
}
