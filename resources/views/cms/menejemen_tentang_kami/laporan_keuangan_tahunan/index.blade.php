@extends('cms.layout.index')
@section('judul', 'Laporan Keuangan Tahunan')
@section('sub-judul', 'Manajemen Tentang Kami')
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
				<!-- <div class="col-xl-12 mb-5 mb-xl-10">
					<div class="card card-flush h-xl-100">
						<div class="card-header pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Data Laporan Keuangan Tahunan</span>
							</h3>
                            <div class="card-toolbar"> 
                            </div>
						</div>
						<div class="card-body pb-0 pt-4">
							<div class="tab-content">
								<div id="chartTahunan" class=" min-h-auto w-100" ></div>
							</div>
						</div>
					</div>
				</div> -->
				<!--end::Col-->
			</div>
			<!--end::Row-->
			
			<!--begin::Row-->
			<div class="row gy-5 g-xl-10">
				<!--begin::Col-->
				<div class="col-xl-12 mb-xl-10">		
					<div class="card card-flush">     
						<div class="card-header mt-6">        
							<div class="card-title">           
								<div class="d-flex align-items-center position-relative my-1 me-5">            
									<p class="card-label fw-bolder text-dark">Data Laporan Keuangan Tahunan</p>
								</div>        
							</div>
                            <div class="card-toolbar"> 
                                <button type="button" class="btn btn-light-success btn-tambah-laporan">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    Tambah Data
                                </button>
                            </div>
						</div>
						 
						<div class="card-body pt-0">     
							<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="tbl-data-laporan-tahunan">
								<thead>
									<tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
										<th class="min-w-50px">No</th>
										<th class="min-w-150px">Tahun</th>
										<!-- <th class="min-w-150px">Rata-rata</th> -->
										<th class="min-w-150px">File</th>
										<th class="min-w-150px">Opsi</th>
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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modal-add-laporan" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Tambah Data</h2>
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
                <div class="card-body pb-0">
                    
                    <div id="response-add"></div>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!-- MODAL UBAH -->
<div class="modal fade" id="modal-edit-laporan" tabindex="-1" aria-hidden="true">
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
                <div class="card-body pb-0">
                    
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
		chartTotalTahunan();

		// get data table
		$("#tbl-data-laporan-tahunan").DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('laporan-keuangan-tahunan.getDataJson') }}",
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
                    data: 'tahun',
                    name: 'tahun',
                },
                // {
                //     data: 'rata_rata',
                //     name: 'rata_rata',
                // },
                {
                    data: 'file',
                    name: 'file',
                },
                {
                    data: 'opsi',
                    name: 'opsi',
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

    var chart;
	// get data chart total download
	function chartTotalTahunan(date) {
        $.ajax({
            url: "{{ route('laporan-keuangan-tahunan.chartLaporan') }}",
            type: 'GET',
            dataType: 'json',
            success: function(response) {

                var options = {
                    series: [{
                        name: 'Rata-rata',
                        data: response.series
                    }],
                    chart: {
                    height: 350,
                    type: 'bar',
                    events: {
                        click: function(chart, w, e) {
                        // console.log(chart, w, e)
                        }
                    }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '45%',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: false
                    },
                    xaxis: {
                        categories: response.categories,
                        labels: {
                            style: {
                            fontSize: '12px'
                            }
                        }
                    }
                };


                if (chart) {
                    chart.destroy();
                }

                // Buat chart baru
                chart = new ApexCharts(document.querySelector("#chartTahunan"), options);
                chart.render();

            }
        });
	}

    function filter_tanggal() {
        var filter = document.getElementById('tahun');

        chartTotalTahunan(filter.value);
    }

    function tableDraw() {
        $("#tbl-data-laporan-tahunan").DataTable().draw(); // Memuat ulang data dari server dan menggambar ulang tabel
    };

    function previewPDF(filePath) {
        window.open(filePath, '_blank');
    }

    // ADD DATA MODAL 
    $('.btn-tambah-laporan').on('click', function() {        
        $.ajax({
            type: "GET",
            url: "{{ route('laporan-keuangan-tahunan.create', '') }}" + '/',
            success: function(response) {
                $('#response-add').html(response);
                $('#modal-add-laporan').modal('show');
            }
        });
    });
    // EDIT DATA MODAL
    function btn_edit_laporan(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('laporan-keuangan-tahunan.edit', '') }}" + '/' + id,
            success: function(response) {
                $('#response-edit').html(response);
                $('#modal-edit-laporan').modal('show');
            }
        });
    }
    // DELETE DATA BUTTON
    function btn_hapus_laporan(id) {
        Swal.fire({
            title: 'Hapus Data',
            text: "Apakah Anda yakin akan menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "{{ route('laporan-keuangan-tahunan.destroy', '') }}" + '/' + id;
            }
        });
    }

</script>
@endsection