<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\BeritaArtikel;
use App\Models\headerPicture;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use Illuminate\Http\Request;
use App\Models\Landing;
use App\Models\TagMeta;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;
use Mockery\Undefined;
use Illuminate\Support\Str;

class BeritadanartikelController extends Controller
{
    public function index_berita(Request $request)
    {
        // $slider = Landing::inRandomOrder()->first();
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Berita')
        ->first();
        
        $kontak = KontakKami::all();
        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();
        $active = 'media';

        $submenu = null;
        return view('landing.berita', compact('slider', 'kontak','tagmeta','active',
            'submenu'));
    }

    public function index_artikel(Request $request)
    {
        // $slider = Landing::inRandomOrder()->first();
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Artikel')
        ->first();
        
        $kontak = KontakKami::all();
        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();
        $active = 'media';

        $submenu = null;
        return view('landing.artikel', compact('slider', 'kontak','tagmeta','active',
            'submenu'));
    }

    public function indexJson_berita(Request $request)
    {
        $locale = App::getLocale() ?: 'en';
        $search = $request->search;
        if(isset($search) && !empty($search) && $search != "undefined"){
            if ($locale == 'id') {
                $berita = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu','kategori','slug')
                    ->where('kategori', 1)     
                    ->where(function($query) use ($search) {
                        $query->where('judul', 'like', "%{$search}%");
                    })
                    ->paginate(9);
            } else{
                $berita = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita_en as isi_berita','total_kunjung','waktu','kategori','slug')
                    ->where('kategori', 1) 
                    ->where(function($query) use ($search) {
                        $query->where('judul_en', 'like', "%{$search}%");
                    })
                    ->paginate(9);
            }
        }else{
            if ($locale == 'id') {
                $berita = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu','kategori','slug')->where('kategori', 1) 
                    ->paginate(9);
            } else {
                $berita = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita_en as isi_berita','total_kunjung','waktu','kategori','slug')->where('kategori', 1) 
                    ->paginate(9);
            }
        }
        return response()->json($berita);
    }

    public function indexJson_artikel(Request $request)
    {
        $locale = App::getLocale() ?: 'en';
        $search = $request->search;
        if(isset($search) && !empty($search) && $search != "undefined"){
            if ($locale == 'id') {
                $berita = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu','kategori','slug')
                    ->where('kategori', 2)     
                    ->where(function($query) use ($search) {
                        $query->where('judul', 'like', "%{$search}%");
                    })
                    ->paginate(9);
            } else{
                $berita = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita_en as isi_berita','total_kunjung','waktu','kategori','slug')
                    ->where('kategori', 2) 
                    ->where(function($query) use ($search) {
                        $query->where('judul_en', 'like', "%{$search}%");
                    })
                    ->paginate(9);
            }
        }else{
            if ($locale == 'id') {
                $berita = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu','kategori','slug')->where('kategori', 2) 
                    ->paginate(9);
            } else {
                $berita = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita_en as isi_berita','total_kunjung','waktu','kategori','slug')->where('kategori', 2) 
                    ->paginate(9);
            }
        }
        return response()->json($berita);
    }
    public function indexBlade(Request $request){
        $data = json_decode($request->data);
        $data = $data->data;
        return view('landing.berita_artikel_konten', compact('data'));
    }

    public function show($slugid)
    {
        try {
            $slug = $slugid;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }

        // $slider = Landing::inRandomOrder()->first();
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Berita')
        ->first();
        
        $kontak = KontakKami::all();
        $base = new BeritaArtikel;
        $berita = $base->where('slug', $slug)->first();
        if($berita->kategori == 1){
            $randomBerita = $base->whereNot('slug',$slug)->where('kategori', $berita->kategori)->inRandomOrder()->paginate(4);
        }else{
            $randomBerita = $base->whereNot('slug',$slug)->where('kategori', $berita->kategori)->inRandomOrder()->paginate(4);
        }
        $active = 'berita-artikel';

        $tagmeta = TagMeta::first();
        $active = 'berita-artikel';
        $submenu = null;
        return view('landing.beritadanartikelDetail', compact('slider', 'kontak', 'berita','randomBerita','tagmeta','active','submenu'));
    }

    public function kunjung_detail_berita(string $id){
        $kunjung = BeritaArtikel::findOrFail($id);
        $kunjung->total_kunjung += 1;
        $kunjung->save();
    }
}
