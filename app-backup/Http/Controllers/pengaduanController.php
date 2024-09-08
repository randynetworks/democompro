<?php

namespace App\Http\Controllers;

use App\Models\headerPicture;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\Landing;
use App\Models\Pengaduan;
use App\Models\TagMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class pengaduanController extends Controller
{
    protected $direktori = 'cms.layanan.pengaduan';

    public function index()
    {
        $data = Pengaduan::all();
        $kontak = KontakKami::all();

        return view($this->direktori . '.index', compact('data','kontak'));
    }

    public function index_landing()
    {

        // $slider = Landing::inRandomOrder()->first();
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Pengaduan')
        ->first();
        
        $tagmeta = TagMeta::first();
        $kontak = KontakKami::all();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();

        $active = 'kontak';
        $submenu = null;
        return view('landing.kontakKami', compact('slider','tagmeta','kontak', 'active','submenu'));
    }

    public function getDataJson(Request $request)
    {
        $data = Pengaduan::select('id','nama_perusahaan','nama_pic','alamat_perusahaan','no_tlp_perusahaan','no_hp_pic','email','lampiran','jenis_layanan','jenis_layanan_lainnya','kategori','uraian','created_at')
        ->orderby('created_at', 'desc');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn  btn-light-success btn-sm me-3" onclick="btn_detail(' . $data->id . ');"><i class="bi bi-arrows-fullscreen "></i></button>';
                $opsi .= '<button class="btn  btn-light-danger btn-sm me-3" onclick="btn_hapus(' . $data->id . ');"><i class="bi bi-trash "></i></button>';
                return $opsi;
            })
            ->editColumn('jenis_layanan',function ($data) {
                if($data->jenis_layanan == 'Reasuransi Jiwa'){
                    $jenis_layanan = '<div class="badge badge-light-success">Reasuransi Jiwa</div>';
                }elseif($data->jenis_layanan == 'Reasuransi Umum'){
                    $jenis_layanan = '<div class="badge badge-light-info">Reasuransi Umum</div>';
                }else{
                    $jenis_layanan = '<div class="badge badge-light-warning">Lainnya</div>';
                }
                return $jenis_layanan;
            })
            ->editColumn('created_at',function ($data) {
                return Carbon::parse($data->created_at)->translatedFormat('d F Y H:i');
            })
            ->rawColumns(['opsi','jenis_layanan','created_at'])
            ->make();
    }

    public function store(Request $request)
    {
        $data = new Pengaduan();

        if ($request->hasFile('lampiran')) {
            $image = $request->file('lampiran');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/lampiran/pengaduan');
            $image->move($destinationPath, $imageName);

            $data->lampiran = $imageName;
        }
        $data->nama_perusahaan = htmlspecialchars(strip_tags($request->nama_perusahaan));
        $data->nama_pic = htmlspecialchars(strip_tags($request->nama_pic));
        $data->alamat_perusahaan = htmlspecialchars(strip_tags($request->alamat_perusahaan));
        $data->no_tlp_perusahaan = htmlspecialchars(strip_tags($request->no_tlp_perusahaan));
        $data->no_hp_pic = htmlspecialchars(strip_tags($request->no_hp_pic));
        $data->email = htmlspecialchars(strip_tags($request->email));
        $data->jenis_layanan = htmlspecialchars(strip_tags($request->jenis_layanan));
        $data->jenis_layanan_lainnya = htmlspecialchars(strip_tags($request->jenis_layanan_lainnya_text));
        $data->kategori = htmlspecialchars(strip_tags($request->kategori));
        $data->uraian = htmlspecialchars(strip_tags($request->uraian));
        $data->created_at = now();

        $data->save();

        return redirect()->route('pengaduan.konsumen')->with('success');
    }

    public function chartTotalPengaduan(Request $request)
    {
        $filter = $request->date;
        $data = Pengaduan::total_pengaduan($filter);
        return response()->json($data);
    }

    public function show(string $id)
    {
        $data = Pengaduan::where('id', $id)->first();

        return view($this->direktori . '.show', compact('data'));
    }

    // public function download($id)
    // {
    //     $data = Pengaduan::find($id)?->lampiran;
    //     $filename = "File Layanan Pengaduan Konsumen";
    //     $path = "images/lampiran/pengaduan";
    //     $file = public_path($path . "/" . $data);
    //     return response()->download($file, $filename);
    // }

    public function download($id)
{
    // Cari pengaduan berdasarkan ID
    // $pengaduan = Pengaduan::find($id);/
    $pengaduan = Pengaduan::where('id', $id)->first();

    if (!$pengaduan) {
        abort(404, 'Pengaduan not found');
    }

    // Ambil nama file lampiran dari pengaduan
    $lampiran = $pengaduan->lampiran;
    $path = "images/lampiran/pengaduan";
    $file = public_path($path . "/" . $lampiran);
    // Periksa apakah file lampiran ada di storage
    if (!file_exists($file)) {
        abort(404, 'File not found');
    }

    // Mendapatkan tipe MIME dari file berdasarkan ekstensi
    $extension = pathinfo($lampiran, PATHINFO_EXTENSION);
    $mime = $this->getMimeType($extension);

    // Nama file untuk diunduh
    $filename = "File Layanan Pengaduan Konsumen";

    // Mengirimkan file untuk diunduh
    return response()->download($file, $filename, ['Content-Type' => $mime]);
}

private function getMimeType($extension)
{
    switch ($extension) {
        case 'txt':
            return 'text/plain';
        case 'jpg':
        case 'jpeg':
            return 'image/jpeg';
        case 'png':
            return 'image/png';
        case 'pdf':
            return 'application/pdf';
        case 'doc':
        case 'docx':
            return 'application/msword';
        default:
            return 'application/octet-stream';
    }
}
    public function destroy(string $id){
        $pengaduan = Pengaduan::find($id);
        $pengaduan->delete();
        return redirect()->route('layanan-pengaduan-konsumen')->with('success');
    }
}
