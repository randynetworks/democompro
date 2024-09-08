@extends('cms.layout.index')
@section('judul', 'Dashboard')
@section('content')

<div class="content d-flex flex-column flex-column-fluid " id="kt_content">
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<div id="kt_content_container" class="container-xxl">
			<div class="row gy-5 g-xl-10">
                <div class="col-xl-12">
                    <div class="card card-flush">
                        <div class="input-group m-5">
                            <div class="input-group-prepend">
                                <span class="input-group-text p-5">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input id="date-picker" name="date-picker" type="text" class="form-control w-100 mw-250px date-picker" placeholder="Pick date range" onchange="filter_tanggal();">
                        </div>
                    </div>
                </div>  
				<div class="col-xl-12 mb-5 mb-xl-10">
					<div class="card card-flush h-xl-100">
						<div class="card-header pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder text-dark">Total Kunjungan</span>
							</h3>
						</div>
						<div class="card-body pb-0 pt-4">
							<div class="tab-content">
								<div id="chartKunjung" class=" min-h-auto w-100" style="height: 300px"></div>
							</div>
						</div>
					</div>
				</div>
				{{-- <div class="col-xl-6 mb-5 mb-xl-10">
					<!--begin::Chart widget 11-->
					<div class="card card-flush h-xl-100">
						<!--begin::Header-->
						<div class="card-header pt-5">
							<!--begin::Title-->
							<h3 class="card-title align-items-start flex-column ">
								<span class="card-label fw-bolder text-dark">Total Download Tata Kelola & Kepatuhan</span>
								<!-- <span class="text-gray-400 mt-1 fw-bold fs-6">Users from all channels</span> -->
							</h3>
							<!--end::Title-->
							<!--begin::Toolbar-->
							<!-- <input id="date-picker" name="date-picker" class="form-control form-control-solid w-100 mw-250px date-picker" placeholder="Pick date range" onchange="filter_tanggal();"> -->

							<!--end::Toolbar-->
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body pb-0 pt-4">
							<!--begin::Tab content-->
							<div class="tab-content">
								<div id="chartTahunan" class=" min-h-auto w-100" style="height: 300px"></div>

							</div>
							<!--end::Tab content-->
						</div>
						<!--end::Body-->
					</div>
					<!--end::Chart widget 11-->
				</div> --}}
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script>
	$(function() {
		initDaterangepicker();
		chartTotalTahunan("30hari");
		chartTotalKunjung("30hari");		
	});

	// date picker range
	var initDaterangepicker = () => {
		var start = moment().subtract(29, "days");
		var end = moment();
		var input = $("#date-picker");

		function cb(start, end) {
			const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
			let startDate = start.date() + " " + months[start.month()] + " " + start.year();
			let endDate = end.date() + " " + months[end.month()] + " " + end.year();
			input.val(startDate + " - " + endDate);
		}

		input.daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				"Today": [moment(), moment()],
				"Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
				"Last 7 Days": [moment().subtract(6, "days"), moment()],
				"Last 30 Days": [moment().subtract(29, "days"), moment()],
			},
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
    
	// get data chart total download
    var chart;
	function chartTotalTahunan(date) {
        $.ajax({
            url: "{{ route('dashboard.chartTotalTahunan') }}?date=" + date,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var data = response.map(item => ({
                    x: new Date(item.nama),
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
                        labels: {
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

                // Buat chart baru
                chart = new ApexCharts(document.querySelector("#chartTahunan"), options);
                chart.render();

            }
        });
	}

    // get data chart total kunjung
    var chart_kunjung;
    // function chartTotalKunjung(date) {
    //     $.ajax({
    //         url: "{{ route('dashboard.chartTotalKunjung') }}?date=" + date,
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function(response) {
    //             var uniqueData = [];
    //             var seenDates = new Set();
    //             response.forEach(item => {
    //                 var date = new Date(item.total_visits).getTime(); // Gunakan timestamp untuk perbandingan
    //                 if (!seenDates.has(date)) {
    //                     seenDates.add(date);
    //                     uniqueData.push({
    //                         x: new Date(item.total_visits),
    //                         y: item.total
    //                     });
    //                 }
    //             });
    //             var options = {
    //                 series: [{
    //                     name: 'Total',
    //                     data: uniqueData
    //                 }],
    //                 chart: {
    //                     type: 'area',
    //                     height: 300,
    //                     toolbar: {
    //                         show: false
    //                     }
    //                 },
    //                 xaxis: {
    //                     type: 'datetime',
    //                     labels: {
    //                         formatter: function(val) {
    //                             var date = new Date(val);
    //                             var options = { year: 'numeric', month: 'short', day: 'numeric' };
    //                             return date.toLocaleDateString('id-ID', options);
    //                         },
    //                         style: {
    //                             colors: '#777',
    //                             fontSize: '13px'
    //                         }
    //                     }
    //                 },
    //                 yaxis: {
    //                     tickAmount: 1, // Jumlah tanda centang sumbu y
    //                     labels: {
    //                         formatter: function(val) {
    //                             return val.toFixed(0); // Menampilkan bilangan bulat saja
    //                         },
    //                         style: {
    //                             colors: '#777',
    //                             fontSize: '13px'
    //                         }
    //                     }
    //                 },
    //                 dataLabels: {
    //                     enabled: false
    //                 },
    //                 colors: ['#00E396'],
    //                 stroke: {
    //                     curve: 'smooth',
    //                     width: 3,
    //                     colors: ['#00E396']
    //                 },
    //                 markers: {
    //                     strokeColors: ['#00E396'],
    //                     strokeWidth: 3
    //                 },
    //                 tooltip: {
    //                     x: {
    //                         format: 'dd MMM yyyy'
    //                     },
    //                 }
    //             };
    //             if (chart_kunjung) {
    //                 chart_kunjung.destroy();
    //             }
    //             // Buat chart baru
    //             chart_kunjung = new ApexCharts(document.querySelector("#chartKunjung"), options);
    //             chart_kunjung.render();
    //         }
    //     });
    // }
    function chartTotalKunjung(date) {
        $.ajax({
            url: "{{ route('dashboard.chartTotalKunjung') }}?date=" + date,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var uniqueData = [];
                var seenDates = new Set();
                response.forEach(item => {
                    var date = new Date(item.total_visits).getTime(); // Gunakan timestamp untuk perbandingan
                    if (!seenDates.has(date)) {
                        seenDates.add(date);
                        uniqueData.push({
                            x: new Date(item.total_visits),
                            y: item.total
                        });
                    }
                });

                var uniqueLabels = Array.from(seenDates).map(date => new Date(date));
                
                var options = {
                    series: [{
                        name: 'Total',
                        data: uniqueData
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
                        labels: {
                            formatter: function(val) {
                                var date = new Date(val);
                                var options = { year: 'numeric', month: 'short', day: 'numeric' };
                                return date.toLocaleDateString('id-ID', options);
                            },
                            style: {
                                colors: '#777',
                                fontSize: '13px'
                            }
                        },
                        tickAmount: uniqueLabels.length, // Sesuaikan jumlah label dengan tanggal unik
                        categories: uniqueLabels, // Tetapkan kategori untuk tanggal unik
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
                if (chart_kunjung) {
                    chart_kunjung.destroy();
                }
                // Buat chart baru
                chart_kunjung = new ApexCharts(document.querySelector("#chartKunjung"), options);
                chart_kunjung.render();
            }
        });
    }


    function filter_tanggal() {
        var datePicker = document.getElementById('date-picker');
        chartTotalTahunan(datePicker.value);
        chartTotalKunjung(datePicker.value);
    }

</script>
@endsection