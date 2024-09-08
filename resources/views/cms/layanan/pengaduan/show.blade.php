@extends('cms.layout.index')
@section('judul', 'Layanan Pengaduan Konsumen')
@section('sub-judul', 'Form Layanan')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<div id="kt_content_container" class="container-xxl">
			<div class="row gy-5 g-xl-10">
				<div class="col-xl-12 mb-5 mb-xl-10">
					<div class="card card-flush h-xl-100">                        
                        <div class="d-flex justify-content-end pt-5 me-5">
                            <a class="btn btn-link btn-sm me-5" href="{{ route('layanan-pengaduan-konsumen') }}">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
									stroke-linejoin="round" class="feather feather-arrow-left">
									<line x1="19" y1="12" x2="5" y2="12"></line>
									<polyline points="12 19 5 12 12 5"></polyline>
								</svg>

								<span class="ms-1">Kembali</span>
							</a>
                        </div>
                        <div class="card-header pt-5">
                            <h3 class="card-title text-gray-800">Layanan Pengaduan Konsumen </h3>
                        </div>
                        <div class="card-body pt-5">                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Waktu Pengaduan</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('DD MMMM YYYY HH:mm:ss') }}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>

                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Nama Perusahaan</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->nama_perusahaan}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Nama PIC</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->nama_pic}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Alamat Perusahaan</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->alamat_perusahaan}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Nomor Telepon Perusahaan</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->no_tlp_perusahaan}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Nomor Handphone PIC</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->no_hp_pic}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>                            
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Alamat Email</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->email}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack mb-2">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Jenis Layanan</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->jenis_layanan}}</span>
                                </div>
                            </div>
                            @if($data->jenis_layanan == 'Lainnya')
                            <div class="d-flex flex-stack mt-5">
                                <div class="text-gray-700 me-2">Keterangan :</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 "  style="max-width: 600px;">{{$data->jenis_layanan_lainnya}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            @else
                                <div class="separator separator-dashed my-3"></div>
                            @endif
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Kategori</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->kategori}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Lampiran</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">
                                    @if($data->lampiran)
                                    <a class="btn btn-sm btn-success" href="{{ asset('images/lampiran/pengaduan/' . $data->lampiran) }}" target="_blank">Lihat File</a>
                                    <!-- <a class="btn btn-sm btn-info" href="{{ route('layanan-pengaduan-konsumen.download', $data->id) }}" target="_blank">Unduh File</a> -->
                                    @endif
                                    </span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Uraian</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6" style="max-width: 600px;">{{$data->uraian}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection

@section('js')
<script>    
</script>
@endsection

