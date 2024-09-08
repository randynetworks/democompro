<?php

namespace App\Http\Controllers;

use App\Models\DataDownload;
use App\Models\KunjungWeb;
use App\Models\TagMeta;
use App\Models\TataKelola;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mnampilkan halaman index dashboard
        return view('cms.dashboard');
    }

    public function getDataJson()
    {
        // json untuk datatable tata kelola dan risiko -> skrang halaman tidak ditampilkan
        $data = TataKelola::select("id","nama","email","kategori","waktu")->orderby('created_at', 'desc');
        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('kategori',function ($data) {
                if ($data->kategori == 'tatakelola') {
                    $ktg = '<div class="badge badge-light-success">Tata Kelola</div>';
                }else if ($data->kategori == 'resiko') {
                    $ktg = '<div class="badge badge-light-warning">Kepatuhan</div>';
                }
                return $ktg;
            })
            ->rawColumns(['kategori'])
            ->make();

        return datatables()->of($data->get())->toJson();
    }

    public function chartTotalTahunan(Request $request)
    {
        // json untuk chart area total download tata kelola dan risiko -> skrang halmaan tidak ditampilkan
        $filter = $request->date;
        $data = TataKelola::total_download($filter);
        return response()->json($data);
    }

    public function chartTotalKunjung(Request $request)
    {
        // json untuk chart area total kunjungan website
        $filter = $request->date;
        $data = KunjungWeb::total_kunjung($filter);
        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
