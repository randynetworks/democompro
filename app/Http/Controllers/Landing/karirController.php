<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\headerPicture;
use App\Models\Joblist;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\Lowongan;
use App\Models\TagMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class karirController extends Controller
{
    public function index(Request $request)
    {
        // jumbroton page
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Karir')
        ->first();
        
        $kontak = KontakKami::all();
        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();
        $active = 'media';

        $submenu = null;
        $lowongan = Lowongan::get()->first()?->url;

        return view('landing.karir', compact('slider', 'kontak','tagmeta','active',
            'submenu','lowongan'));
    }

    public function indexJson_karir(Request $request)
    {
        $locale = App::getLocale() ?: 'en';
        $search = $request->search;
        if(isset($search) && !empty($search) && $search != "undefined"){
            if ($locale == 'id') {
                $karir = Joblist::select('id','gambar','judul','deskripsi','slug','created_at')     
                    ->where(function($query) use ($search) {
                        $query->where('judul', 'like', "%{$search}%");
                    })
                    ->orderby('waktu', 'desc')
                    ->paginate(9);
            } else{
                $karir = Joblist::select('id','gambar','judul_en as judul','deskripsi_en as deskripsi','slug','created_at') 
                    ->where(function($query) use ($search) {
                        $query->where('judul_en', 'like', "%{$search}%");
                    })
                    ->orderby('waktu', 'desc')
                    ->paginate(9);
            }
        }else{
            if ($locale == 'id') {
                $karir = Joblist::select('id','gambar','judul','deskripsi','slug','created_at') 
                    ->orderby('waktu', 'desc')
                    ->paginate(9);
            } else {
                $karir = Joblist::select('id','gambar','judul_en as judul','deskripsi_en as deskripsi','slug','created_at') 
                    ->orderby('waktu', 'desc')
                    ->paginate(9);
            }
        }
        return response()->json($karir);
    }

    
    public function indexBlade(Request $request){
        // untuk response json konten karir
        $data = json_decode($request->data);
        $data = $data->data;
        return view('landing.karir_konten', compact('data'));
    }

    public function show($slugid)
    {
        try {
            $slug = $slugid;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }

        // jumbroton page
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Karir')
        ->first();
        
        $kontak = KontakKami::all();

        $base = new Joblist();
        $job = $base->where('slug', $slug)->first();
        $randomJob = $base->whereNot('slug',$slug)->inRandomOrder()->paginate(4);

        $tagmeta = TagMeta::first();
        
        $active = 'media';
        $submenu = null;
        
        return view('landing.karirDetail', compact('slider', 'kontak', 'job','randomJob','tagmeta','active','submenu'));
    }
}
