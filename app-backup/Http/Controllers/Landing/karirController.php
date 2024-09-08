<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\headerPicture;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\Lowongan;
use App\Models\TagMeta;
use Illuminate\Http\Request;

class karirController extends Controller
{
    public function index(Request $request)
    {
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
}
