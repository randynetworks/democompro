<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\headerPicture;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use App\Models\Landing;
use App\Models\TagMeta;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class SertifikasiController extends Controller
{
    public function index_sertifikasi()
    {
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Sertifikasi')
        ->first();
        $kontak = KontakKami::all();
        $filter_tahun = Sertifikat::filter_tahun();

        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();
        $active = 'media';
        $submenu = null;
        return view('landing.sertifikasi', compact('slider', 'kontak','tagmeta','filter_tahun','active',
            'submenu'));
    }

    public function index_penghargaan()
    {
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Penghargaan')
        ->first();
        $kontak = KontakKami::all();
        $filter_tahun = Sertifikat::filter_tahun();

        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();
        $active = 'media';
        $submenu = null;
        return view('landing.penghargaan', compact('slider', 'kontak','tagmeta','filter_tahun','active',
            'submenu'));
    }

    public function indexJson_sertifikasi(Request $request)
    {
        $locale = App::getLocale() ?: 'en';
        $search = $request->search;

        if($search != "undefined" && !empty($search)){
            if ($locale == 'id') {
                $sertifikat = Sertifikat::select('id','gambar','nama','kategori','waktu')
                    ->where('kategori', 1)    
                    ->where(function($query) use ($search) {
                        $query->where('nama', 'like', "%{$search}%");
                    })
                    ->paginate(9);
            } elseif($locale == 'en') {
                $sertifikat = Sertifikat::select('id','gambar','nama_en as nama','kategori','waktu')
                    ->where('kategori', 1)    
                    ->where(function($query) use ($search) {
                        $query->where('nama_en', 'like', "%{$search}%");
                    })
                    ->paginate(9);
            }
        }else{
            if ($locale == 'id') {
                $sertifikat = Sertifikat::select('id','gambar','nama','kategori','waktu')
                    ->where('kategori', 1)    
                    ->paginate(9);
            } else {
                $sertifikat = Sertifikat::select('id','gambar','nama_en as nama','kategori','waktu')
                    ->where('kategori', 1)    
                    ->paginate(9);
            }
        }

        return response()->json($sertifikat);
    }

    public function indexJson_penghargaan(Request $request)
    {
        $locale = App::getLocale() ?: 'en';
        $search = $request->search;

        if($search != "undefined" && !empty($search)){
            if ($locale == 'id') {
                $sertifikat = Sertifikat::select('id','gambar','nama','kategori','waktu')
                    ->where('kategori', 2)    
                    ->where(function($query) use ($search) {
                        $query->where('nama', 'like', "%{$search}%");
                    })
                    ->paginate(9);
            } elseif($locale == 'en') {
                $sertifikat = Sertifikat::select('id','gambar','nama_en as nama','kategori','waktu')
                    ->where('kategori', 2)    
                    ->where(function($query) use ($search) {
                        $query->where('nama_en', 'like', "%{$search}%");
                    })
                    ->paginate(9);
            }
        }else{
            if ($locale == 'id') {
                $sertifikat = Sertifikat::select('id','gambar','nama','kategori','waktu')
                    ->where('kategori', 2)    
                    ->paginate(9);
            } else {
                $sertifikat = Sertifikat::select('id','gambar','nama_en as nama','kategori','waktu')
                    ->where('kategori', 2)    
                    ->paginate(9);
            }
        }

        return response()->json($sertifikat);
    }

    public function indexBlade(Request $request){
        $data = json_decode($request->data);
        $data = $data->data;
        return view('landing.sertifikat_konten', compact('data'));
    }

    public function show($id)
    {
        $sertifikat = Sertifikat::find($id);
        return view('landing.sertifikatDetail', ['value' => $sertifikat]);
    }

    public function download($id)
    {
        $data = Sertifikat::find($id)?->gambar;
        $filename = "Sertifikat";
        $path = "images/sertifikat";
        $file = public_path($path . "/" . $data);
        return response()->download($file, $filename);
    }
}
