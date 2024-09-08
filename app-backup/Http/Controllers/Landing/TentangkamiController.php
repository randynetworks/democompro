<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\headerPicture;
use App\Models\JajaranKami;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\LaporanKeuangan;
use App\Models\laporanTahunan;
use App\Models\MasterJabatan;
use App\Models\Profil;
use App\Models\Tujuan;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use App\Models\Landing;
use App\Models\TagMeta;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TentangkamiController extends Controller
{
    public function index()
    {

        $locale = App::getLocale() ?: 'en';

        if($locale == 'id'){
            $profile = Profil::select('id','nama_perusahaan','deskripsi','gambar','status_gambar','url_youtube','status_youtube')?->first();
            $vision_and_mission = VisiMisi::select('id','visi','misi')?->first();
            $goal = Tujuan::select('id','tujuan')?->first();

        }else{
            $profile = Profil::select('id','nama_perusahaan','deskripsi_en as deskripsi','gambar','status_gambar','url_youtube','status_youtube')?->first();
            $vision_and_mission = VisiMisi::select('id','visi_en as visi','misi_en as misi')?->first();
            $goal = Tujuan::select('id','tujuan_en as tujuan')?->first();

        }
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Tentang Kami')
        ->first();

        $kontak = KontakKami::all();

        $stucture_organitations = new JajaranKami;
        $jabatans = MasterJabatan::select('id','jabatan','jabatan_en','level','status_tampil')->where('status_tampil', 1)->where('level', '!=', 5)->orderBy('level', 'asc')->get();
    
        $kadiv = new JajaranKami;
        $jabatans_kadiv = MasterJabatan::select('id','jabatan','jabatan_en','level','status_tampil')->where('level', 5)->orderBy('level', 'asc')->get();

        $tagmeta = TagMeta::first();
        $user = User::first();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();
        $active = 'about_us';

        $submenu =[];
        array_push($submenu, [
            'nama' => 'Kami Adalah',
            'nama_en' => 'We Are',
            'url' => 'about-us'
        ]);
        // array_push($submenu, [
        //     'nama' => 'Berita & Artikel',
        //     'nama_en' => 'News & Articles',
        //     'url' => 'about-structur'
        // ]);
        array_push($submenu, [
            'nama' => 'Laporan Keuangan',
            'nama_en' => 'Financial Report',
            'url' => 'about-laporan'
        ]);
        $gambarStrukturOrganisasi = $this->getStructureImageName();
        return view(
            'landing.tentangkami',
            compact(
                'slider',
                'profile',
                'vision_and_mission',
                'gambarStrukturOrganisasi',
                'goal',
                'kontak',
                'stucture_organitations',
                'jabatans',
                'jabatans_kadiv',
                'kadiv',
                'tagmeta',
                'active',
                'submenu',
                'user'
            )
        );
    }

    public function Allchart()
    {
        $bulanan = LaporanKeuangan::chart_laporan(null);
        $tahunan = laporanTahunan::chart_laporan();

        return response()->json([
            'bulan' => $bulanan,
            'tahun' => $tahunan
        ]);
    }

    public function listData(Request $r)
    {
        $tipe = $r->tipe;
        $bulan = LaporanKeuangan::where('bulan', 'like', '%' . now()->format('Y') . '%')->get();
        $tahun = laporanTahunan::all();
        return view('landing.listLaporan', compact('tipe', 'bulan', 'tahun'));
    }

    public function download($id, $tipe)
    {
        $base = $tipe == 'bulan' ? LaporanKeuangan::find($id) : laporanTahunan::find($id);
        $data = $tipe == 'bulan' ? $base?->file : $base?->file;
        $path = $tipe == 'bulan' ? '/images/laporan' : '/images/laporan-tahunan';
        $filename = $tipe == "bulan" ? 'Laporan-Bulan-' . $base?->bulan : 'laporan-Tahun-' . $base?->tahun;
        $file = public_path($path . "/" . $data);
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($file, $filename, $headers);
    }
    public function getStructureImageName()
    {
        $directory = public_path('images/struktur_organisasi');
        $files = File::files($directory);

        if (count($files) > 0) {
            $firstFile = $files[0]->getFilename();
            return $firstFile;
        } else {
            return '';
        }
    }
}
