<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Documentasi;
use App\Models\headerPicture;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\Sertifikat;
use App\Models\TagMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class dokumentasiController extends Controller
{
    public function index()
    {
        // jumbroton page
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Dokumentasi')
        ->first();

        $kontak = KontakKami::all();
        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();

        $active = 'media';
        $submenu = null;

        return view('landing.dokumentasi', compact('slider', 'kontak','tagmeta','active','submenu'));
    }

    public function indexJson(Request $request)
    {
        $locale = App::getLocale() ?: 'en';
        $search = $request->search;

        if($search != "undefined" && !empty($search)){
            if ($locale == 'id') {
                $documentasi = Documentasi::select('id','gambar','text','kategori','waktu')   
                    ->where(function($query) use ($search) {
                        $query->where('text', 'like', "%{$search}%");
                    })
                    ->orderby('waktu', 'desc')
                    ->paginate(9);
            } elseif($locale == 'en') {
                $documentasi = Documentasi::select('id','gambar','text_en as text','kategori','waktu')   
                    ->where(function($query) use ($search) {
                        $query->where('text_en', 'like', "%{$search}%");
                    })
                    ->orderby('waktu', 'desc')
                    ->paginate(9);
            }
        }else{
            if ($locale == 'id') {
                $documentasi = Documentasi::select('id','gambar','text','kategori','waktu')   
                    ->orderby('waktu', 'desc')
                    ->paginate(9);
            } else {
                $documentasi = Documentasi::select('id','gambar','text_en as text','kategori','waktu')   
                    ->orderby('waktu', 'desc')
                    ->paginate(9);
            }
        }

        return response()->json($documentasi);
    }

    public function indexBlade(Request $request){
        $data = json_decode($request->data);
        $data = $data->data;
        return view('landing.dokumentasi_konten', compact('data'));
    }
}
