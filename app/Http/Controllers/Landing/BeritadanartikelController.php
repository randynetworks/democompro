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
        // jumbroton berita
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Berita')
        ->first();
        
        // kontak kami untuk footer
        $kontak = KontakKami::all();
        // tag meta untuk SEO
        $tagmeta = TagMeta::first();

        // kunjungan web count
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();
        $active = 'media';

        $submenu = null;
        return view('landing.berita', compact('slider', 'kontak','tagmeta','active',
            'submenu'));
    }

    public function index_artikel(Request $request)
    {
        // jumbroton artikel
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Artikel')
        ->first();
        
        // kontak kami untuk footer
        $kontak = KontakKami::all();
        // tag meta untuk SEO
        $tagmeta = TagMeta::first();

        // kunjungan web count
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();
        
        // untuk aktif navbar
        $active = 'media';
        $submenu = null;

        return view('landing.artikel', compact('slider', 'kontak','tagmeta','active',
            'submenu'));
    }

    public function indexJson_berita(Request $request)
    {
        // jika getLocale tiak ada maka default 'en'
        $locale = App::getLocale() ?: 'en'; 
        // request search
        $search = $request->search;
        // jika search ada dan kosong/empty/undifined/null
        if(isset($search) && !empty($search) && $search != "undefined"){
            // jika localization == id
            if ($locale == 'id') {
                // getdata berita (kategori=1)
                $berita = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu','kategori','slug')
                    ->where('kategori', 1)     
                    ->where(function($query) use ($search) {
                        $query->where('judul', 'like', "%{$search}%"); //cari judul yg mengandung request search
                    })
                    ->orderby('waktu', 'desc') //orderby waktu dari yang terbaru ke terlama
                    ->paginate(9); //paginate 9 data
            // jika localization == en
            } else{
                // get data berita (kategori=1)
                $berita = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita_en as isi_berita','total_kunjung','waktu','kategori','slug')
                    ->where('kategori', 1) 
                    ->where(function($query) use ($search) {
                        $query->where('judul_en', 'like', "%{$search}%"); //cari judul yg mengandung request search
                    })
                    ->orderby('waktu', 'desc')//orderby waktu dari yang terbaru ke terlama
                    ->paginate(9); //paginate 9 data
            }
        // jika tidak ada request search
        }else{
            // jika localization == id
            if ($locale == 'id') {
                // getdata berita(kategori=1)
                $berita = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu','kategori','slug')
                ->where('kategori', 1) 
                ->orderby('waktu', 'desc')//orderby waktu dari yang terbaru ke terlama
                ->paginate(9); //paginate 9 data
            } else {
                // getdata berita(kategori=1)
                $berita = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita_en as isi_berita','total_kunjung','waktu','kategori','slug')
                ->where('kategori', 1) 
                ->orderby('waktu', 'desc')  //orderby waktu dari yang terbaru ke terlama
                ->paginate(9); //paginate 9 data
            }
        }
        return response()->json($berita);
    }

    public function indexJson_artikel(Request $request)
    {
        // jika getLocale tiak ada maka default 'en'
        $locale = App::getLocale() ?: 'en';
        // request search
        $search = $request->search;
        // jika search kosong/undifined/empty/null
        if(isset($search) && !empty($search) && $search != "undefined"){
            // jika localization == id
            if ($locale == 'id') {
                // getdata berita (kategori=2) 
                $berita = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu','kategori','slug')
                    ->where('kategori', 2)     
                    ->where(function($query) use ($search) {
                        $query->where('judul', 'like', "%{$search}%");
                    })
                    ->orderby('waktu', 'desc') //orderby waktu dari yang terbaru ke terlama
                    ->paginate(9); //paginate 9 data
            } else{
                $berita = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita_en as isi_berita','total_kunjung','waktu','kategori','slug')
                    ->where('kategori', 2) 
                    ->where(function($query) use ($search) {
                        $query->where('judul_en', 'like', "%{$search}%");
                    })
                    ->orderby('waktu', 'desc') //orderby waktu dari yang terbaru ke terlama
                    ->paginate(9); //paginate 9 data
            }
        }else{
            if ($locale == 'id') {
                $berita = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu','kategori','slug')
                ->where('kategori', 2) 
                ->orderby('waktu', 'desc') //orderby waktu dari yang terbaru ke terlama
                ->paginate(9); //paginate 9 data
            } else {
                $berita = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita_en as isi_berita','total_kunjung','waktu','kategori','slug')
                ->where('kategori', 2) 
                ->orderby('waktu', 'desc')   //orderby waktu dari yang terbaru ke terlama
                ->paginate(9); //paginate 9 data
            }
        }
        return response()->json($berita);
    }
    
    public function indexBlade(Request $request){
        // ini untuk konten di dalam halaman blade 
        // saya buat jadi bentuk response json
        $data = json_decode($request->data);
        $data = $data->data;
        return view('landing.berita_artikel_konten', compact('data'));
    }

    public function show($slugid)
    {
        // untuk detail berita & artikel
        try { // cek apakah memiliki slug atau tidak
            $slug = $slugid;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }

        // jumbroton page
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

        $tagmeta = TagMeta::first();
    
        $active = 'berita-artikel';
        $submenu = null;

        return view('landing.beritadanartikelDetail', compact('slider', 'kontak', 'berita','randomBerita','tagmeta','active','submenu'));
    }

    public function kunjung_detail_berita(string $id)
    {
        // menghitung banyak kunjungan berita & artikel
        $kunjung = BeritaArtikel::findOrFail($id);
        $kunjung->total_kunjung += 1;
        $kunjung->save();
    }
}
