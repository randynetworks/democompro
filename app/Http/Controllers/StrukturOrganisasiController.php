<?php

namespace App\Http\Controllers;

use App\Models\headerPicture;
use App\Models\JajaranKami;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\Landing;
use App\Models\MasterJabatan;
use App\Models\TagMeta;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        // jumbroton page
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Struktur Organisasi')
        ->first();

        $kontak = KontakKami::all();
        $stucture_organitations = new JajaranKami;

        // urutkan master jabatan berdasrkan level secara asc 
        $jabatans = MasterJabatan::orderBy('level')->get();

        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();

        $active = 'structure_organization';
        $submenu = null;
        
        return view('landing.strukturorganisasi', compact('slider','kontak','stucture_organitations','jabatans', 'tagmeta', 'active','submenu'));
    }
}
