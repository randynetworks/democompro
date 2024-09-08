<?php

namespace App\Http\Controllers;

use App;
use App\Models\headerPicture;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\Landing;
use App\Models\TagMeta;
use App\Models\Solusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SolusiController extends Controller
{
    public function index()
    {

        $content = [];
        $content["categories"] = [];
        $content["categories"]["id"] = [];
        $content["categories"]["en"] = [];
        $content["content"] = [];

        $datas = Solusi::with('details')->get();

        foreach ($datas as $solusi) {
            $content["categories"]["id"][] = [
                "lang" => "id",
                "name" => $solusi->kategori
            ];
            $content["categories"]["en"][] = [
                "lang" => "en",
                "name" => $solusi->kategori_en
            ];
            $category_en = [
                "lang" => "en",
                'category' => $solusi->kategori_en,
                'details' => []
            ];
            $category_id = [
                "lang" => "id",
                'category' => $solusi->kategori,
                'details' => []
            ];

            foreach ($solusi->details as $detail) {
                $category_en['details'][] = [
                    'judul' => $detail->judul_en,
                    'deskripsi' => $detail->deskripsi_en
                ];
                $category_id['details'][] = [
                    'judul' => $detail->judul,
                    'deskripsi' => $detail->deskripsi
                ];
            }

            $content['content']['id'][] = $category_id;
            $content['content']['en'][] = $category_en;
        }
        $locale = App::getLocale() ?: 'en';
        
        // $slider = Landing::inRandomOrder()->first();
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'solusi')
        ->first();

        $kontak = KontakKami::all();
        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();
        // Log::debug($content);
        // dd($content);
        $active = 'solusi';
        $submenu = null;
        return view('landing.solusi', compact('content', 'slider', 'kontak','tagmeta','locale','active','submenu'));
    }
}
