@extends('cms.layout.index')
@section('judul', 'Tata Kelola')
@section('sub-judul', 'Manajemen Beranda')
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<!--begin::Row-->
			<div class="row gy-5 g-xl-10">
				<!--begin::Col-->
                
				<div class="col-xl-12">		
					<div class="card card-flush"> 
                        <div class="card-body">
                            <div class="col-12 row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">
                                        <!--begin::Icon-->
                                        <span class="svg-icon svg-icon-warning me-5">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor" />
                                                    <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <div class="flex-grow-1 me-2">
                                            <p class="fw-bolder text-gray-800 text-hover-primary fs-6">Pedoman Umum Tata Kelola</p>
                                            <!-- <span >Lihat File</span> -->                                            
                                            <a href="{{ asset('images/tatakelola/' . $file->tata_kelola) }}" target="_blank" class="text-primary fw-bold d-block">Lihat File</a>
                                        </div>
                                        <button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_edit_tatakelola({{ $file->id }});"><i class="bi bi-pencil fs-4"></i></button>
                                        <!--end::Lable-->
                                    </div>
                                </div>
                                <div class="col-md-6">                                    
                                    <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">
                                        <!--begin::Icon-->
                                        <span class="svg-icon svg-icon-warning me-5">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor" />
                                                    <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <div class="flex-grow-1 me-2">
                                            <p class="fw-bolder text-gray-800 text-hover-primary fs-6">Risiko & Kepatuhan</p>
                                            <!-- <span class="text-muted fw-bold d-block">lihat File</span> -->
                                            <a href="{{ asset('images/tatakelola/' . $file->risiko) }}" target="_blank" class="text-primary fw-bold d-block">Lihat File</a>

                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Lable-->
                                        <!-- <span class="fw-bolder text-warning py-1" onclick="btn_edit_tatakelola(" .{{$file->id}}. ")">Ubah</span> -->
                                        <button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_edit_risiko({{ $file->id }});"><i class="bi bi-pencil fs-4"></i></button>
                                        <!--end::Lable-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-xl-12 mb-xl-10">		
					<div class="card card-flush">     
						<div class="card-header mt-6">        
							<div class="card-title">           
								<div class="d-flex align-items-center position-relative my-1 me-5">            
									<p class="card-label fw-bolder text-dark">Data Download Tata Kelola & Kepatuhan</p>
								</div>        
							</div>
						</div>
						 
						<div class="card-body pt-0">     
							<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="tbl-data-unduh">
								<thead>
									<tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
										<th class="min-w-50px">No</th>
										<th class="min-w-150px">Nama</th>
										<th class="min-w-150px">Email</th>
										<th class="min-w-150px">Kategori</th>
										<th class="min-w-150px">Waktu</th>
									</tr>
								</thead>
								<tbody class="fw-bold text-gray-600">
								</tbody>              
							</table>          
						</div>      
					</div>
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>


<!-- MODAL UBAH -->
<div class="modal fade" id="modal-edit-tatakelola" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Ubah Data</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body py-lg-10 px-lg-10">
                <div class="card-body pb-0 pt-10">

                    <div id="response-edit"></div>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
@endsection

@section('js')
<script>
	$(function() {
		// get data table
		$("#tbl-data-unduh").DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('manajemen-tata-kelola.getDataJson') }}",
                type: "POST",
            },
            "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",
            language: {
                emptyTable: "Tidak ada data yang tersedia",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                lengthMenu: "Tampilkan _MENU_ data",
                loadingRecords: "Memuat...",
                processing: "Sedang memproses...",
                search: "Cari:",
                zeroRecords: "Tidak ditemukan data yang sesuai",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya",
                },
                aria: {
                    sortAscending: ": aktifkan untuk mengurutkan kolom secara ascending",
                    sortDescending: ": aktifkan untuk mengurutkan kolom secara descending",
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'kategori',
                    name: 'kategori',
                },
                {
                    data: 'waktu',
                    name: 'waktu',
                },
            ],
            "columnDefs": [
                {
                    "targets": '_all',
                    "defaultContent": "-",
                    "className": "text-center"
                },                
            ]
        });
	});

    function btn_edit_tatakelola(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('file-tata-kelola.edit_tatakelola', '') }}" + '/' + id,
            success: function(response) {
                $('#response-edit').html(response);
                $('#modal-edit-tatakelola').modal('show');
            }
        });
    }

    function btn_edit_risiko(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('file-tata-kelola.edit_risiko', '') }}" + '/' + id,
            success: function(response) {
                $('#response-edit').html(response);
                $('#modal-edit-tatakelola').modal('show');
            }
        });
    }
</script>
@endsection