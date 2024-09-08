<?php

namespace App\Http\Controllers;

use App\Models\headerPicture;
use App\Models\KontakKami;
use App\Models\KunjungWeb;
use App\Models\Landing;
use App\Models\TagMeta;
use App\Models\Whistleblowing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WhistleblowingController extends Controller
{
    protected $direktori = 'cms.layanan.Whistleblowing';

    public function index()
    {
        $data = Whistleblowing::all();
        return view($this->direktori . '.index', compact('data'));
    }

    public function index_landing()
    {

        // $slider = Landing::inRandomOrder()->first();
        $slider = headerPicture::select('gambar')
        ->where('kategori', 'Whistleblowing')
        ->first();
        
        $tagmeta = TagMeta::first();
        $kontak = KontakKami::all();

        // kunjungan web
        $kunjungWeb = new KunjungWeb();
        $kunjungWeb->incrementTotalVisits();

        $active = 'kontak';
        $submenu = null;
        return view('landing.kontakKami_Whistleblowing', compact('slider','tagmeta','kontak','active','submenu'));
    }

    public function getDataJson(Request $request)
    {
        $data = Whistleblowing::select('id','nama_pelapor','no_tlp_pelapor','email_pelapor','tindakan_yang_dilaporkan','tindakan_yang_dilaporkan_lainnya','lampiran','nama_terlapor','jabatan_terlapor','waktu','lokasi','kronologis','nominal','created_at')
        ->orderby('created_at', 'desc');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                $opsi = '';
                $opsi .= '<button class="btn  btn-light-success btn-sm me-3" onclick="btn_detail(' . $data->id . ');"><i class="bi bi-arrows-fullscreen "></i></button>';
                $opsi .= '<button class="btn  btn-light-danger btn-sm me-3" onclick="btn_hapus(' . $data->id . ');"><i class="bi bi-trash "></i></button>';
                return $opsi;
            })
            ->editColumn('tindakan_yang_dilaporkan',function ($data) {
                if($data->tindakan_yang_dilaporkan == 'Fraud'){
                    $tindakan_yang_dilaporkan = '<div class="badge badge-light-success">Fraud</div>';
                }elseif($data->tindakan_yang_dilaporkan == 'Pelanggaran Kode Etik'){
                    $tindakan_yang_dilaporkan = '<div class="badge badge-light-info">Pelanggaran Kode Etik</div>';
                }elseif($data->tindakan_yang_dilaporkan == 'Pelanggaran Benturan Kepentingan'){
                    $tindakan_yang_dilaporkan = '<div class="badge badge-light-primary">Pelanggaran Benturan Kepentingan</div>';
                }elseif($data->tindakan_yang_dilaporkan == 'Pelanggaran Hukum'){
                    $tindakan_yang_dilaporkan = '<div class="badge badge-light-warning">Pelanggaran Hukum</div>';
                }else{
                    $tindakan_yang_dilaporkan = '<div class="badge badge-light-danger">Lainnya</div>';
                }
                return $tindakan_yang_dilaporkan;
            })
            ->editColumn('created_at',function ($data) {
                return Carbon::parse($data->created_at)->translatedFormat('d F Y H:i');
            })
            ->rawColumns(['opsi','tindakan_yang_dilaporkan','created_at'])
            ->make();
    }

    public function store(Request $request)
    {
        $data = new Whistleblowing();

        if ($request->hasFile('lampiran')) {
            $image = $request->file('lampiran');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images/lampiran/whistleblowing');
            $image->move($destinationPath, $imageName);

            $data->lampiran = $imageName;
        }

        $data->nama_pelapor = htmlspecialchars(strip_tags($request->nama_pelapor));
        $data->no_tlp_pelapor = htmlspecialchars(strip_tags($request->no_tlp_pelapor));
        $data->email_pelapor = htmlspecialchars(strip_tags($request->email_pelapor));
        $data->tindakan_yang_dilaporkan = htmlspecialchars(strip_tags($request->tindakan_yang_dilaporkan));
        $data->tindakan_yang_dilaporkan_lainnya = htmlspecialchars(strip_tags($request->tindakan_yang_dilaporkan_lainnya_text));
        $data->nama_terlapor = htmlspecialchars(strip_tags($request->nama_terlapor));
        $data->jabatan_terlapor = htmlspecialchars(strip_tags($request->jabatan_terlapor));
        $data->waktu = htmlspecialchars(strip_tags($request->waktu));
        $data->lokasi = htmlspecialchars(strip_tags($request->lokasi));
        $data->kronologis = htmlspecialchars(strip_tags($request->kronologis));
        $data->nominal = htmlspecialchars(strip_tags($request->nominal));
        $data->created_at = now();

        $data->save();

        return redirect()->route('whistleblowing')->with('success');
    }

    public function chartTotalWhistleblowing(Request $request)
    {
        $filter = $request->date;
        $data = Whistleblowing::total_whistleblowing($filter);
        return response()->json($data);
    }

    public function show(string $id)
    {
        $data = Whistleblowing::where('id', $id)->first();

        return view($this->direktori . '.show', compact('data'));
    }

    public function destroy(string $id){
        $pengaduan = Whistleblowing::find($id);
        $pengaduan->delete();
        return redirect()->route('layanan-whistleblowing')->with('success');
    }
}
