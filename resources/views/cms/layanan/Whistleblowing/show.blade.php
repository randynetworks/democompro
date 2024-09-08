@extends('cms.layout.index')
@section('judul', 'Whistleblowing')
@section('sub-judul', 'Form Layanan')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<div id="kt_content_container" class="container-xxl">
			<div class="row gy-5 g-xl-10">
				<div class="col-xl-12 mb-5 mb-xl-10">
					<div class="card card-flush h-xl-100">
                        <div class="d-flex justify-content-end pt-5 me-5">
                            <a class="btn btn-link btn-sm me-5" href="{{ route('layanan-whistleblowing') }}">
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
                            <h3 class="card-title text-gray-800">Whistleblowing</h3>
                        </div>
                        <div class="card-body pt-5">                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Waktu Kejadian</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{ $data->waktu}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>

                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Nama Pelapor</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->nama_pelapor}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Nomor Telepon Pelapor</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->no_tlp_pelapor}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Email Pelapor</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->email_pelapor}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack mb-2">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Tindakan/Perbuatan yang dilaporkan</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->tindakan_yang_dilaporkan}}</span>
                                </div>
                            </div>
                            @if($data->tindakan_yang_dilaporkan == 'Lainnya')
                            <div class="d-flex flex-stack mt-5">
                                <div class="text-gray-700 me-2">Keterangan :</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 "  style="max-width: 600px;">{{$data->tindakan_yang_dilaporkan_lainnya}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            @else
                                <div class="separator separator-dashed my-3"></div>
                            @endif
                                                        
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Lampiran</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">
                                    @if($data->lampiran)
                                    <a class="btn btn-sm btn-success" href="{{ asset('images/lampiran/whistleblowing/' . $data->lampiran) }}" target="_blank">Lihat File</a>
                                    @endif
                                    </span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Nama Terlapor</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6" style="max-width: 600px;">{{$data->nama_terlapor}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Jabatan Terlapor</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->jabatan_terlapor}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Lokasi Kejadian</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->lokasi}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">kronologis</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->kronologis}}</span>
                                </div>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            
                            <div class="d-flex flex-stack">
                                <div class="text-gray-700 fw-bold fs-6 me-2">Nominal</div>
                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-900 fw-boldest fs-6"  style="max-width: 600px;">{{$data->nominal}}</span>
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

