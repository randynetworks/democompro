<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class profilController extends Controller
{

    protected $direktori = 'cms.menejemen_perusahaan.profil';

    public function index()
    {
        $data = Profil::first();
        $imagePath = public_path('images/profil_perusahaan/' . $data->gambar);
        $data->imageExists = File::exists($imagePath);

        return view($this->direktori . '.index', compact('data'));
    }

    public function getDataJson()
    {
        $data = Profil::select("id","gambar","nama_perusahaan","deskripsi")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn btn-icon btn-light-warning btn-sm me-3" onclick="btn_edit_profil(' . $data->id . ');"><i class="bi bi-pencil fs-4"></i></button>';
                return $opsi;
            })
            ->editColumn('gambar',function ($data) {
                $alt = $data['gambar'];
                // $img = '<img src="/images/profil_perusahaan/' . $alt . '" alt="$alt" height="174px" width="174px">';
                $img = '<img src="' . asset('images/profil_perusahaan/' . $alt) . '" alt="' . $alt . '" max-height="174px" width="174px">';
                return $img;
            })
            ->addColumn('deskripsi', function($data) {
                return strlen($data->deskripsi) > 20 ? substr($data->deskripsi, 0, 50) . '...' : $data->deskripsi;
            })
            ->rawColumns(['opsi', 'gambar', 'deskripsi'])
            ->make();
    }

    public function edit(string $id)
    {
        $data = Profil::where('id', $id)->first();
        return view($this->direktori . '.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profil = Profil::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            // Pindahkan file gambar yang diunggah ke direktori public/profil
            $destinationPath = public_path('/images/profil_perusahaan');
            // Hapus file lama jika ada
            if ($profil->gambar) {
                $oldImagePath = $destinationPath . '/' . $profil->gambar;
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image->move($destinationPath, $imageName);

            $profil->gambar = $imageName;
        }

        $profil->nama_perusahaan = $request->nama_perusahaan;
        $profil->deskripsi = $request->deskripsi;
        $profil->deskripsi_en = $request->deskripsi_en;
        $profil->url_youtube = $this->getYoutubeEmbedUrl($request->url_youtube);
        $profil->save();
        
        session()->flash('sukses', 'Update Data Berhasil');

        return redirect()->route('profil-perusahaan');
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
    
    public function updateStatus(Request $request, $id)
    {
        $profil = Profil::findOrFail($id);

        // Toggle status_youtube: if it is 1, set it to 0; otherwise, set it to 1
        $profil->status_youtube = $profil->status_youtube == 1 ? 0 : 1;
        
        // Set status_gambar to the opposite of status_youtube
        $profil->status_gambar = $profil->status_youtube == 1 ? 0 : 1;
        
        $profil->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}
