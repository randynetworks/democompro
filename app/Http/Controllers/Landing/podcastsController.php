<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use App\Models\headerPicture;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\podcast;
use App\Models\TagMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;

class podcastsController extends Controller
{
    public function index(Request $request)
    {
        // jumbroton page
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Video')
        ->first();
        
        $kontak = KontakKami::all();
        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();
        $active = 'media';

        $submenu = null;
        return view('landing.podcast', compact('slider', 'kontak','tagmeta','active',
            'submenu'));
    }

    public function indexJson(Request $request)
    {
        $locale = App::getLocale() ?: 'en';
        $search = $request->search;
        if(isset($search) && !empty($search) && $search != "undefined"){
            if ($locale == 'id') {
                $podcast = podcast::select('id','youtube_link','youtube_link_embed','video_file','judul') 
                    ->where(function($query) use ($search) {
                        $query->where('judul', 'like', "%{$search}%");
                    })
                    ->orderby('created_at', 'desc')
                    ->paginate(9);
            } else{
                $podcast = podcast::select('id','youtube_link','youtube_link_embed','video_file','judul_en as judul')
                    ->where(function($query) use ($search) {
                        $query->where('judul_en', 'like', "%{$search}%");
                    })
                    ->orderby('created_at', 'desc')
                    ->paginate(9);
            }
        }else{
            if ($locale == 'id') {
                $podcast = podcast::select('id','youtube_link','youtube_link_embed','video_file','judul')
                    ->orderby('created_at', 'desc')
                    ->paginate(9);
            } else {
                $podcast = podcast::select('id','youtube_link','youtube_link_embed','video_file','judul_en as judul')
                    ->orderby('created_at', 'desc')
                    ->paginate(9);
            }
        }
        return response()->json($podcast);
    }

    public function indexBlade(Request $request){
        $data = json_decode($request->data);
        $data = $data->data;
        return view('landing.podcast_konten', compact('data'));
    }
}
