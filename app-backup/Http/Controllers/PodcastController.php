<?php

namespace App\Http\Controllers;

use App\Models\podcast;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PodcastController extends Controller
{
    protected $direktori = 'cms.podcast';

    public function index()
    {
        $data = podcast::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        $data = podcast::select("id","url","judul","judul_en")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_podcast(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_podcast(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('url', function ($data) {
                $url = htmlspecialchars($data->url);
                $maxLength = 35;
            
                if (strlen($url) > $maxLength) {
                    $shortUrl = substr($url, 0, $maxLength) . '...';
                } else {
                    $shortUrl = $url;
                }
            
                return '<a href="' . $url . '" target="_blank">' . $shortUrl . '</a>';
            })
            ->addColumn('judul', function($data) {
                return strlen($data->judul) > 20 ? substr($data->judul, 0, 35) . '...' : $data->judul;
            }) 
            ->rawColumns(['opsi','url', 'judul'])
            ->make();
    }

    public function create()
    {
        return view($this->direktori . '.create');
    }

    public function store(Request $request)
    {
        $data = new podcast();

        $data->url = $request->url;
        $data->embed = $this->getYoutubeEmbedUrl($request->url);
        $data->judul = $request->judul;
        $data->judul_en = $request->judul_en;
        $data->save();
        
        session()->flash('sukses', 'Tambah Data Berhasil');

        return redirect()->route('podcast');
    }

    private function getYoutubeEmbedUrl($url)
    {
        if (strpos($url, 'youtube.com/embed') !== false) {
            return $url;
        }
        // Ubah URL YouTube menjadi URL embed jika perlu
        if (strpos($url, 'youtube.com') !== false) {
            $urlParts = parse_url($url);
            parse_str($urlParts['query'], $queries);
            $videoId = $queries['v'] ?? null;
            if ($videoId) {
                return "https://www.youtube.com/embed/{$videoId}";
            }
        } elseif (strpos($url, 'youtu.be') !== false) {
            $videoId = substr($url, strrpos($url, '/') + 1);
            return "https://www.youtube.com/embed/{$videoId}";
        }

        return $url; // Jika sudah dalam format embed
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = podcast::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {

        $data = podcast::findOrFail($id);
        
        $data->url = $request->url;
        $data->embed = $this->getYoutubeEmbedUrl($request->url);
        $data->judul = $request->judul;
        $data->judul_en = $request->judul_en;
        $data->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('podcast');
    }

    public function destroy(string $id)
    {
        $data = podcast::findOrFail($id);
        $delete = $data->delete();

        if ($delete) {
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('podcast');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('podcast');
        }
    }
}
