@extends('cms.layout.index')
@section('judul', 'Layanan Pengaduan Konsumen')
@section('sub-judul', 'Form Layanan')
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
				<div class="col-xl-12 mb-5 mb-xl-10">
					<!--begin::Chart widget 11-->
					<div class="card card-flush h-xl-100">
						<!--begin::Header-->
						<div class="card-header pt-5">
							<!--begin::Title-->
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Total Pengaduan Konsumen</span>
								<!-- <span class="text-gray-400 mt-1 fw-bold fs-6">Users from all channels</span> -->
							</h3>
							<!--end::Title-->
							<!--begin::Toolbar-->
							<input id="date-picker" name="date-picker" class="form-control form-control-solid w-100 mw-250px date-picker" placeholder="Pick date range" onchange="filter_tanggal();">

							<!--end::Toolbar-->
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body pb-0 pt-4">
							<!--begin::Tab content-->
							<div class="tab-content">
								<div id="chartPengaduan" class=" min-h-auto w-100" style="height: 300px"></div>

							</div>
							<!--end::Tab content-->
						</div>
						<!--end::Body-->
					</div>
					<!--end::Chart widget 11-->
				</div>
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
									<p class="card-label fw-bolder text-dark">Data Pengaduan Konsumen</p>
								</div>        
							</div>
						</div>
						 
						<div class="card-body pt-0">     
							<table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="tbl-data-pengaduan">
								<thead>
									<tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
										<th class="min-w-50px">No</th>
										<th class="min-w-200px">Nama Perusahaan</th>
										<th class="min-w-150px">Nomor Telepon</th>
										<!-- <th class="min-w-150px">Email</th> -->
										<th class="min-w-150px">Jenis Layanan</th>
										<th class="min-w-100px">Waktu</th>
										<th class="min-w-50px">Opsi</th>
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

@endsection

@section('js')
<script>
	$(function() {
		initDaterangepicker();
		chartTotalPengaduan("30hari");
        
        $("#tbl-data-pengaduan").DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('layanan-pengaduan-konsumen.getDataJson') }}",
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
                    data: 'nama_perusahaan',
                    name: 'nama_perusahaan',
                },
                {
                    data: 'no_tlp_perusahaan',
                    name: 'no_tlp_perusahaan',
                },
                {
                    data: 'jenis_layanan',
                    name: 'jenis_layanan',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'opsi',
                    name: 'opsi',
                },
            ],
            "columnDefs": [
                {
                    "targets": [0],
                    "defaultContent": "-",
                    "className": "text-center",
                },                
            ]
        }); 
	});

    // membuat daterange picker custom
	var initDaterangepicker = () => {
        // default filter
		var start = moment().subtract(29, "days");
		var end = moment();
		var input = $("#date-picker");

        // formating bulan
		function cb(start, end) {
			const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
			let startDate = start.date() + " " + months[start.month()] + " " + start.year();
			let endDate = end.date() + " " + months[end.month()] + " " + end.year();
			input.val(startDate + " - " + endDate);
		}

        // membuat range
		input.daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				"Today": [moment(), moment()],
				"Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
				"Last 7 Days": [moment().subtract(6, "days"), moment()],
				"Last 30 Days": [moment().subtract(29, "days"), moment()],
			},
            // formating
			locale: {
				format: 'MM/DD/YYYY', // internal format for the plugin
				applyLabel: "Apply",
				cancelLabel: "Cancel",
				fromLabel: "From",
				toLabel: "To",
				customRangeLabel: "Custom",
				weekLabel: "W",
				daysOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
				monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
				firstDay: 1
			}
		}, cb);

		input.on('apply.daterangepicker', function(ev, picker) {
			cb(picker.startDate, picker.endDate);
		});

		cb(start, end);
	} 

    // set data ke chart area
    var chart;
	function chartTotalPengaduan(date) {
        $.ajax({
            url: "{{ route('layanan-pengaduan-konsumen.chartTotalPengaduan') }}?date=" + date,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var data = response.map(item => ({
                    x: new Date(item.nama_perusahaan),
                    y: item.total
                }));

                var options = {
                    series: [{
                        name: 'Total',
                        data: data
                    }],
                    chart: {
                        type: 'area',
                        height: 300,
                        toolbar: {
                            show: false
                        }
                    },
                    xaxis: {
                        type: 'datetime',
                        labels: { // formater labels
                            formatter: function(val) {
                                var date = new Date(val);
                                var options = { year: 'numeric', month: 'short', day: 'numeric' };
                                return date.toLocaleDateString('id-ID', options);
                            },
                            style: {
                                colors: '#777',
                                fontSize: '13px'
                            }
                        }
                    },
                    yaxis: {
                        tickAmount: 1, // Jumlah tanda centang sumbu y
                        labels: {
                            formatter: function(val) {
                                return val.toFixed(0); // Menampilkan bilangan bulat saja
                            },
                            style: {
                                colors: '#777',
                                fontSize: '13px'
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    colors: ['#00E396'],
                    stroke: {
                        curve: 'smooth',
                        width: 3,
                        colors: ['#00E396']
                    },
                    markers: {
                        strokeColors: ['#00E396'],
                        strokeWidth: 3
                    },
                    tooltip: {
                        x: {
                            format: 'dd MMM yyyy'
                        },
                    }
                };

                if (chart) {
                    chart.destroy();
                }

                // render ulang chart tiap ada perubahan
                chart = new ApexCharts(document.querySelector("#chartPengaduan"), options);
                chart.render();

            }
        });
	}

    // tiap perubahan filter tanggal
    function filter_tanggal() {
        var datePicker = document.getElementById('date-picker');
        // render ulang chart dengan filter tanggal
        chartTotalPengaduan(datePicker.value);
    }

    // DETAIL BUTTON
    function btn_detail(id) {
        window.location.href = "{{ route('layanan-pengaduan-konsumen.show', '') }}" + '/' + id;
    }
    // DELETE DATA BUTTON
    function btn_hapus(id) {
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
                window.location = "{{ route('layanan-pengaduan-konsumen.destroy', '') }}" + '/' + id;
            }
        });
    }
</script>
@endsection