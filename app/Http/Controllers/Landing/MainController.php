<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\BeritaArtikel;
use App\Models\Documentasi;
use App\Models\dynamic_menu;
use App\Models\FileTataKelola;
use App\Models\Jadwal;
use App\Models\JajaranKami;
use App\Models\Joblist;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\Landing;
use App\Models\Lowongan;
use App\Models\nilai;
use App\Models\nilaiByGambar;
use App\Models\podcast;
use App\Models\Sertifikat;
use App\Models\TagMeta;
use App\Models\TataKelola;
use App\Models\Ucapan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    public function index()
    {
        $locale = App::getLocale() ?: 'en';

        if($locale == 'id'){
            $landings = Landing::select('id','gambar','nama_perusahaan','motto','deskripsi')->get();
            $nilais = nilai::select('id','icon','text','deskripsi','gambar')->get();
            $ucapans = Ucapan::select('ucapans.id','ucapans.gambar','ucapans.nama','ucapans.id_jabatan_fk','ucapans.deskripsi','ucapans.tagline','master_jabatans.id','master_jabatans.jabatan', 'master_jabatans.level')
            ->leftJoin('master_jabatans', 'ucapans.id_jabatan_fk', '=', 'master_jabatans.id')
            ->get();
            $beritaArtikels = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu as created_at','slug')->get();
            $sertifikasis = Sertifikat::select('id','gambar','nama','kategori','waktu')->get();
            $dokumentasi = Documentasi::select('id','gambar','text','kategori','waktu')->get();
            $podcast = Podcast::latest('created_at')->first(['id', 'youtube_link','youtube_link_embed','video_file', 'judul']);

            // Dian
            $lastBerita = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu as created_at','kategori','slug')->orderBy('id', 'DESC')->where('kategori', 1)->first();
            $lastArtikel = BeritaArtikel::select('id','thumbnail','judul','isi_berita','total_kunjung','waktu as created_at','kategori','slug')->orderBy('id', 'DESC')->where('kategori', 2)->first();
            $lastSertifikat = Sertifikat::select('id','gambar','nama','kategori','waktu')->orderBy('id', 'DESC')->where('kategori', 1)->first();
            $lastPenghargaan = Sertifikat::select('id','gambar','nama','kategori','waktu')->orderBy('id', 'DESC')->where('kategori', 2)->first();
            $lastKegiatan = Documentasi::select('id','gambar','text','kategori','waktu')->orderBy('id', 'DESC')->first();
            $lastKarir = Joblist::select('gambar','judul','deskripsi','waktu','slug',)->orderBy('id', 'DESC')->first();
        }else{
            $landings = Landing::select('id','gambar','nama_perusahaan','motto_en as motto','deskripsi_en as deskripsi')->get();
            $nilais = nilai::select('id','icon','text_en as text','deskripsi_en as deskripsi','gambar')->get();
            $ucapans = Ucapan::select('ucapans.id','ucapans.gambar','ucapans.nama','ucapans.id_jabatan_fk','ucapans.deskripsi_en as deskripsi','ucapans.tagline_en as tagline','master_jabatans.id','master_jabatans.jabatan_en as jabatan', 'master_jabatans.level')
            ->leftJoin('master_jabatans', 'ucapans.id_jabatan_fk', '=', 'master_jabatans.id')
            ->get();
            $beritaArtikels = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita_en as isi_berita','total_kunjung','waktu as created_at','slug')->get();
            $sertifikasis = Sertifikat::select('id','gambar','nama_en as nama','kategori','waktu')->get();
            $dokumentasi = Documentasi::select('id','gambar','text_en as text','kategori','waktu')->get();
            $podcast = Podcast::latest('created_at')->first(['id', 'youtube_link','youtube_link_embed','video_file', 'judul_en as judul']);
            
            // Dian
            $lastBerita = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita','total_kunjung','waktu as created_at','kategori','slug')->orderBy('id', 'DESC')->where('kategori', 1)->first();
            $lastArtikel = BeritaArtikel::select('id','thumbnail','judul_en as judul','isi_berita','total_kunjung','waktu as created_at','kategori','slug')->orderBy('id', 'DESC')->where('kategori', 2)->first();
            $lastSertifikat = Sertifikat::select('id','gambar','nama_en as nama','kategori','waktu')->orderBy('id', 'DESC')->where('kategori', 1)->first();
            $lastPenghargaan = Sertifikat::select('id','gambar','nama_en as nama','kategori','waktu')->orderBy('id', 'DESC')->where('kategori', 2)->first();
            $lastKegiatan = Documentasi::select('id','gambar','text_en as text','kategori','waktu')->orderBy('id', 'DESC')->first();
            $lastKarir = Joblist::select('gambar','judul_en as judul','deskripsi_en as deskripsi','waktu','slug',)->orderBy('id', 'DESC')->first();
        }

        $beritaArtikelsCount = BeritaArtikel::count("*");
        $beritaPage = ceil($beritaArtikelsCount / 4);

        $sertifikasisCount = Sertifikat::count("*");
        $sertifikasiPage = ceil($sertifikasisCount / 3);

        $dokumentasiCount = Documentasi::count("*");
        $dokumentasiPage = ceil($dokumentasiCount / 4);

        $kontak = KontakKami::all();
        $lowongan = Lowongan::get()->first()?->url;
        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();

        $nilai_by_gambar = nilaiByGambar::first();
        $user = User::first();

        $active = 'home';

        // sub menu
        $submenu =[];
        array_push($submenu, [
            'nama' => 'Selamat Datang',
            'nama_en' => 'Welcome',
            'url' => 'beranda-welcome'
        ]);
        array_push($submenu, [
            'nama' => 'Berita & Artikel',
            'nama_en' => 'News & Articles',
            'url' => 'beranda-berita'
        ]);
        array_push($submenu, [
            'nama' => 'Sertifikasi & Penghargaan',
            'nama_en' => 'Certification & Awards',
            'url' => 'beranda-sertifikat'
        ]);
        array_push($submenu, [
            'nama' => 'Karir',
            'nama_en' => 'Career',
            'url' => 'beranda-karir'
        ]);
        array_push($submenu, [
            'nama' => 'Dokumentasi',
            'nama_en' => 'Documentation',
            'url' => 'beranda-kegiatan'
        ]);
        array_push($submenu, [
            'nama' => 'Kalender',
            'nama_en' => 'Calender',
            'url' => 'beranda-kalender'
        ]);

        return view(
            'landing.index',
            compact(
                'landings',
                'nilais',
                'ucapans',
                'beritaArtikels',
                'beritaPage',
                'sertifikasis',
                'sertifikasisCount',
                'sertifikasiPage',
                'dokumentasi',
                'dokumentasiCount',
                'dokumentasiPage',
                'kontak',
                'lowongan',
                'tagmeta',
                'nilai_by_gambar',
                'user',
                'active',
                'submenu',
                'lastBerita',
                'lastArtikel',
                'lastSertifikat',
                'lastPenghargaan',
                'lastKegiatan',
                'lastKarir',
                'podcast'
            )
        );

        // tampilan maintenence
        // return view('disabled');
    }

    public function dynamicMenuJson(){
        // menu dinamis
        $locale = App::getLocale() ?: 'en';
        if($locale == 'id'){
            $dynamic_menu = dynamic_menu::select('id','navbar','body')->get();
        }else{
            $dynamic_menu = dynamic_menu::select('id','navbar_en as navbar','body')->get();
        }

        return response()->json([
            'dynamic_menu' => $dynamic_menu,
            'locale' => $locale,
        ]);
    }

    public function getDynamicContent(string $id)
    {
        $slider = Landing::inRandomOrder()->first();
        $kontak = KontakKami::all();
        $tagmeta = TagMeta::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();

        $content = dynamic_menu::find($id);
        if ($content) {
            return view('landing.dynamic_menu', [
                'body' => $content->body,
                'content' =>$content,
                'slider' => $slider,
                'kontak' => $kontak,
                'tagmeta' => $tagmeta,
            ]);
        } else {
            abort(404, 'Content not found');
        }
    }

    public function profile($id)
    {
        $locale = App::getLocale() ?: 'en';

        if($locale == 'id'){
            $item = JajaranKami::select('id','gambar','nama','deskripsi','id_jabatan_fk','tagline','tagline_en')->find($id);
        }else{
            $item = JajaranKami::select('id','gambar','nama','deskripsi_en as deskripsi','id_jabatan_fk','tagline','tagline_en')->find($id);
        }
        return view('landing.profile', ['item' => $item]);
    }

    public function downloadTataKelola(Request $r)
    {
        // post data diri sebelum download tata kelola dan risiko -> skrang menu tidak ditampilkan
        $data = $r->validate(
            [
                'nama' => 'required',
                'email' => 'required|email',
                'kategori' => 'required',
            ],
            [
                'nama.required' => "Nama Tidak Boleh Kosong",
                'email.required' => 'Email Tidak Boleh Kosong',
                'email.email' => "Input harus berupa email"
            ]
        );
        $data['waktu'] = Carbon::now('Asia/Jakarta');
        $base = new TataKelola;
        $base->create($data);
        $total = $base->where('email', $r->email)->get()->count();
        return response()->json(['status' => 'success', 'total' => $total]);
    }

    public function download(Request $r)
    {
        // fungsi download tata kelola dan risiko -> sekarang menu tidak ditampilkan
        $data_pdf = FileTataKelola::first();
        $data = $r->kategori == 'tatakelola' ? $data_pdf->tata_kelola : $data_pdf->risiko;
        $path = $r->kategori == 'tatakelola' ? '/images/tatakelola' : '/images/tatakelola';
        $filename = $r->kategori == "tatakelola" ? 'Pedoman Umum Tata Kelola.pdf' : 'Resiko dan Kepatuhan.pdf';
        $file = public_path($path . "/" . $data);
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, $filename, $headers);
    }

    public function jadwalChart()
    {
        // calendar getdata untuk jadwal -> untuk skrang menu tidak ditampilkan 
        $day = Carbon::now();
        $from = $day->startOfMonth()->toDateString();
        $to = $day->endOfMonth()->toDateString();
        $data = Jadwal::where(function ($query) use ($from, $to) {
            $query->where('start_date', '>=', $from)
                ->where('end_date', '<=', $to);
        })->get();


        $data = $data->map(function ($value) {
            $locale = App::getLocale() ?: 'en';
            if($locale == 'id'){
                $deskripsi = $value->deskripsi;
                $headline = $value->headline;
            }else{
                $deskripsi = $value->deskripsi_en;
                $headline = $value->headline_en;
            }

            return (object) [
                'title' => $headline,
                'start' => $value->start_date,
                'end' => $value->end_date,
                'description' => $deskripsi
            ];
        });
        return response()->json($data);
    }

    public function jadwalList(Request $r)
    {
        // detail jadwal kegiatan di calendar -> skrang menu tidak ditampilkan
        $day = Carbon::now();
        $date = $r->date;
        $data = Jadwal::where(function ($query) use ($date) {
            $query->where('start_date', 'like', '%' . $date . '%')->orWhere('end_date', 'like', '%' . $date . '%');
        })->get();
        return view('landing.listJadwal', compact('data'));
    }
}
