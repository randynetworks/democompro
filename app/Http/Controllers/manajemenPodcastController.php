<?php

namespace App\Http\Controllers;

use App\Models\podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class manajemenPodcastController extends Controller
{
    // direktori blade
    protected $direktori = 'cms.podcast';

    public function index()
    {
        $data = podcast::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        // json untuk datatable
        $data = podcast::select("id","judul","judul_en")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_podcast(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                $opsi .= '<button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_hapus_podcast(' . $data->id . ');"><i class="bi bi-trash fs-4"></i></button>';
                return $opsi;
            })
            ->addColumn('judul', function($data) {
                // str limit untuk membatasi string yang terlalu panjang
                return strlen($data->judul) > 30 ? substr($data->judul, 0, 40) . '...' : $data->judul;
            }) 
            ->rawColumns(['opsi', 'judul']) // render html di datatable
            ->make();
    }

    public function create()
    {
        // menampilkan halaman tambah data
        return view($this->direktori . '.create');
    }

    public function store(Request $request)
    {
        // fungsi tambah data
        $data = new podcast();

        $data->youtube_link = $request->youtube_link;
        $data->youtube_link_embed = $this->getYoutubeEmbedUrl($request->youtube_link); //ubah url youtube jadi url embed
        if ($request->hasFile('video_file')) { // cek apakah ada request file
            $video = $request->file('video_file');  // jikaada maka ambil filnya
            $videoName = time().'.'.$video->getClientOriginalExtension(); // membuat nama file -> stempel waktu unix saat ini + ekstensi file asli

            $destinationPath = public_path('/images/podcast'); // direktori file disimpan
            $video->move($destinationPath, $videoName); // menyimpan  file ke direktori

            $data->video_file = $videoName; // menyimpan nama file di database
        }
        $data->judul = $request->judul;
        $data->judul_en = $request->judul_en;
        $data->save();
        
        session()->flash('sukses', 'Tambah Data Berhasil');

        return redirect()->route('video');
    }

    private function getYoutubeEmbedUrl($url)
    {
        //  fungsi untuk mengubah url youtube menjadi url embed agar kita bisa embed video youtube di web kita
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

        return $url; // return dalam format embed
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //menampilkan halaman ubah data
        $data = podcast::where('id', $id)->first();

        return view($this->direktori . '.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        //  fungsi untuk update data
        $data = podcast::findOrFail($id);
        
        // jika input type 'video_file' dan video_file di database null dan memiliki request file
        // maka langsung simpan video file saja
        if ($request->inputType == "video_file" && $data->video_file == null && $request->hasFile('video_file')) {
            $video = $request->file('video_file');
            $videoName = time().'.'.$video->getClientOriginalExtension();

            $destinationPath = public_path('/images/podcast');
            $video->move($destinationPath, $videoName);

            $data->video_file = $videoName;
            $data->youtube_link = null;
            $data->youtube_link_embed = null;

        // jika input type 'video_file' dan video_file di database ada dan memilki request file
        // maka harus remove file video yang ada dan simpan file video yang baru
        }elseif ($request->inputType == "video_file" && $data->video_file != null && $request->hasFile('video_file')) {
            $image = $request->file('video_file');
            $videoName = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/podcast');

            if ($data->video_file) {
                $oldImagePath = $destinationPath . '/' . $data->video_file;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image->move($destinationPath, $videoName);

            $data->video_file = $videoName;
            $data->youtube_link = null;
            $data->youtube_link_embed = null;

        // jika input type 'youtube_link' 
        }elseif($request->inputType == "youtube_link"){
            $destinationPath = public_path('/images/podcast'); // cek apakah memiliki video_file didirektori
            $oldImagePath = $destinationPath . '/' . $data->video_file;
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath); // jika iya maka remove dulu file video di direktori
            }
            $data->video_file = null;
            $data->youtube_link = $request->youtube_link;
            $data->youtube_link_embed = $this->getYoutubeEmbedUrl($request->youtube_link); // memanggil fungsu untuk mengubah url youtube menjadi url embed agar kita bisa embed video youtube di web kita
        }
        $data->judul = $request->judul;
        $data->judul_en = $request->judul_en;
        $data->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('video');
    }

    public function destroy(string $id)
    {
        // fungsi hapus data
        $data = podcast::findOrFail($id);

        $videoName = $data->video_file; // ambil nama file dari data yang akan dihapus

        $delete = $data->delete(); // hapus data

        if ($delete) {
            if ($videoName) {
                $Path = public_path('/images/podcast/' . $videoName); // hapus file lama di direktori jika ada
                if (File::exists($Path)) {
                    File::delete($Path);
                }
            }
            session()->flash('sukses', 'Hapus Data Berhasil');
            return redirect()->route('video');
        }else{
            session()->flash('gagal', 'Hapus Data Gagal');
            return redirect()->route('video');
        }
    }
}
