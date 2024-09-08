@extends('landing.layouts.index')

@section('content')
    <!-- Tentang Kami -->
    <section class=" d-table w-100 bg-half-260"
        style="background: url('{{ asset('images/image-header/' . $slider->gambar) }}'); height: 75vh; background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div class="py-5 px-5">
            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reindo Syariah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('tentang_kami.heading')</li>
                    </ul>
                </nav>
            </div>
        </div> <!--end container-->
    </section>

    <div class="position-relative">
        <div class="shape overflow-hidden text-color-white">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Profile kami adalah-->
    <section class="section" id="about-us">
        @if ($profile)
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        @if ($profile)
                            @if ($profile->status_gambar == 1)
                                <img src="{{ file_exists(public_path('images/profil_perusahaan/' . $profile->gambar)) ? asset('images/profil_perusahaan/' . $profile->gambar) : asset('landric/images/hosting/bg.png') }}"
                                    alt="Profil Perusahaan" class="img-fluid rounded">
                            @elseif($profile->status_youtube == 1)
                                <!-- <iframe width="550" height="305" src="{{ $profile->url_youtube }}" frameborder="0" allowfullscreen></iframe> -->
                                <div class="embed-responsive embed-responsive-16by9"
                                    style="height: 0; overflow: hidden; position: relative; padding-bottom: 56.25%; padding-top: 30px; height: 0; overflow: hidden;">
                                    <iframe class="embed-responsive-item" src="{{ $profile->url_youtube }}" allowfullscreen
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="col-md-7">
                        <div class="d-flex flex-column">
                            <h4 class="fw-bold text-center text-md-start text-biru-1 mt-2">{{ $profile ? $profile->nama_perusahaan : '' }}</h4>
                            <!-- <h3 class="text-muted text-center text-md-start">{{ $profile ? $profile->nama_perusahaan : '' }} </h3> -->
                            <p class="text-muted" style="text-align: justify">
                                {!! $profile ? $profile->deskripsi : '' !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="container mt-100 mt-40">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <a href="javascript:void(0)"
                        class="d-flex features feature-primary key-feature align-items-start p-3 rounded shadow ">
                        <div class="icon text-center rounded-circle h4 me-3 mb-0">
                            <i class="uil uil-bag"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="mb-0">@lang('tentang_kami.visi')</h4>
                            <h5 class="title text-dark">{!! $vision_and_mission ? $vision_and_mission->visi : '' !!}</h5>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 mb-4">
                    <a href="javascript:void(0)"
                        class="d-flex features feature-primary key-feature align-items-start p-3 rounded shadow flex-md-1 ms-md-2">
                        <div class="icon text-center rounded-circle h4 me-3 mb-0">
                            <i class="uil uil-rocket"></i>
                        </div>
                        <div class="flex-1">
                            <h4>@lang('tentang_kami.misi')</h4>
                            <h5 class="title text-dark mb-0">{!! $vision_and_mission ? $vision_and_mission?->misi : '' !!}</h5>
                        </div>
                    </a>
                </div>

                <div class="col-md-12 mt-2 align-items-stretch">
                    <a href="javascript:void(0)"
                        class="d-flex features feature-primary key-feature align-items-start p-3 rounded shadow flex-md-1 ms-md-2">
                        <div class="icon text-center rounded-circle h4 me-3 mb-0">
                            <i class="uil uil-focus-target "></i>
                        </div>
                        <div class="flex-1">
                            <h4>@lang('tentang_kami.tujuan')</h4>
                            <h5 class="title text-dark mb-0">{!! $goal ? $goal?->tujuan : '' !!}</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .key-feature {
            height: 100%;
        }
    </style>

    <!-- structure organtisation -->
    @php
        $i = 1;
        $bg = 'bg-white';
    @endphp
    <section class="section bg-light" id="struktur-organisasi">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <div class="title-heading">
                        <h1 class="heading fw-bold mb-2">@lang('tentang_kami.struktur_organisasi')</h1>
                        <!-- <p class="para-desc mx-auto text-muted">@lang('tentang_kami.deskripsi_gambar_struktur')</p> -->
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="home-dashboard">
                                <img src='{{ asset("images/struktur_organisasi/$gambarStrukturOrganisasi") }}' alt="" class="img-fluid rounded-md shadow-lg" style="z-index: 0;object-fit:contain;height:100%;"
                                onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                            </div>
                        </div>
                    </div><!--end row-->
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </section>
    <!-- manajemen -->
    <section class="section" id="top-management">
        <div class="container mb-5">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h4 class="mb-4 fs-1 text fw-bold">@lang('tentang_kami.top_manajemen')</h4>
            </div>
        </div>
        @foreach ($jabatans as $key => $value)
            <div class="d-flex flex-column justify-content-center align-items-center">
                <p class="mb-4 mt-40 fs-1 text ">
                    @if (App::getLocale() == 'id')
                        {{ $value->jabatan ?? '' }}
                    @elseif(App::getLocale() == 'en')
                        {{ $value->jabatan_en ?? '' }}
                    @endif
                </p>
            </div>
            <div class="container mt-40 mt-2">
                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                    @foreach ($stucture_organitations->whereHas('jabatan', fn($query) => $query->where('jabatan', $value->jabatan))->get() as $item)
                        <div class="col mb-4">
                            <div class="card team team-primary text-center border-0">
                                <div class="position-relative">
                                    <style>
                                        @media (min-width: 768px) and (max-width: 1199px) {
                                            .responsive-img {
                                                object-fit: contain;
                                                object-position: bottom;
                                                height: 269.2px;
                                            }
                                        }
                                    </style>
                                    <img src="{{ asset('images/jajaran-kami/' . $item?->gambar) }}"
                                        class="img-fluid rounded responsive-img" alt="" style="height: 269.2px;"
                                        onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                                        <!-- style="height: 350px;" -->
                                    <ul class="list-unstyled mb-0 team-icon">
                                        <li class="list-inline-item">
                                            <a href="javascript:void(0)"
                                                class="btn btn-primary btn-pills btn-sm btn-icon btn-profile" data-bs-toggle="modal" data-bs-target="#modalShow" data-id="{{ $item->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul><!--end icon-->
                                </div>
                                <div class="card-body py-3 px-0 content">
                                    <h5 class="mb-0"><a href="javascript:void(0)"
                                            class="name text-dark">{{ $item->nama ?? '' }}</a></h5>
                                    <small class="designation text-muted">
                                        @if (App::getLocale() == 'id')
                                            {{ $item->tagline ?? '' }}
                                        @elseif(App::getLocale() == 'en')
                                            {{ $item->tagline_en ?? '' }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
    <!-- kadiv -->
    <section class="section" id="kepala-divisi">
        <div class="container">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h4 class="mb-4 fs-1 text fw-bold">
                    @if (App::getLocale() == 'id')
                        {{ $jabatans_kadiv[0]->jabatan ?? '' }}
                    @elseif(App::getLocale() == 'en')
                        {{ $jabatans_kadiv[0]->jabatan_en ?? '' }}
                    @endif
                </h4>
            </div>
        </div>
        @foreach ($jabatans_kadiv as $key => $values)
            <div class="container mt-5 mt-40 ">
                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                    @foreach ($kadiv->whereHas('jabatan', fn($query) => $query->where('jabatan', $values->jabatan))->get() as $items)
                        <div class="col mb-4">
                            <div class="card team team-primary text-center border-0">
                                <div class="position-relative">
                                    <img src="{{ asset('images/jajaran-kami/' . $items?->gambar) }}"
                                        class="img-fluid rounded responsive-img" alt="" style="height: 350px;"
                                        onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                                    <ul class="list-unstyled mb-0 team-icon">
                                        <li class="list-inline-item">
                                            <a href="javascript:void(0)"
                                                class="btn btn-primary btn-pills btn-sm btn-icon btn-profile" data-bs-toggle="modal" data-bs-target="#modalShow" data-id="{{ $items->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul><!--end icon-->
                                </div>
                                <div class="card-body py-3 px-0 content">
                                    <h5 class="mb-0"><a href="javascript:void(0)"
                                            class="name text-dark">{{ $items->nama ?? '' }}</a></h5>
                                    <small class="designation text-muted">
                                        @if (App::getLocale() == 'id')
                                            {{ $items->tagline ?? '' }}
                                        @elseif(App::getLocale() == 'en')
                                            {{ $items->tagline_en ?? '' }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
    <!-- laporan keuangan -->
    <section class="section" id="laporan-keuangan">
        <div class="container">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h4 class="mb-4 fs-1 text fw-bold" style="font-family: Maven Pro, sans-serif">@lang('tentang_kami.laporan.judul')</h4>
                <!-- <p class="text-muted">@lang('tentang_kami.laporan.sub_judul')</p> -->
            </div>
        </div>
        <div class="px-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 mt-4 pt-2 text-center">
                    <ul class="nav nav-pills nav-justified flex-column flex-sm-row rounded bg-light wow animate__ animate__fadeInUp animated"
                        data-wow-delay=".3s" id="pills-tab" role="tablist"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">

                        <li class="nav-item" role="presentation">
                            <a class="nav-link rounded active" id="teamwork-tab" data-bs-toggle="pill"
                                href="#pills-teamwork" role="tab" aria-controls="pills-teamwork"
                                aria-selected="true">
                                <div class="text-center py-2">
                                    <h6 class="mb-0">@lang('tentang_kami.laporan.button_bulanan')</h6>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link rounded" id="selfservice-tab" data-bs-toggle="pill" href="#pills-self"
                                role="tab" aria-controls="pills-self" aria-selected="false" tabindex="-1">
                                <div class="text-center py-2">
                                    <h6 class="mb-0">@lang('tentang_kami.laporan.button_tahunan')</h6>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-4 pt-2">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="pills-self" role="tabpanel" aria-labelledby="selfservice-tab">
                            <!-- <div class="d-flex justify-content-between align-items-center">
                                                            <h5>@lang('tentang_kami.laporan.button_tahunan')</h5>
                                                            <button class="btn btn-primary btn-laporan" data-tipe="tahun">@lang('tentang_kami.laporan.button_download')</button>
                                                        </div> -->
                            <!-- <canvas id="financialReportChartTahunan" width="400" height="200"></canvas> -->
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-success btn-laporan" data-tipe="tahun">
                                    @lang('tentang_kami.laporan.button_download_tahun')
                                </button>
                            </div>
                        </div>

                        <div class="tab-pane fade active show" id="pills-teamwork" role="tabpanel"
                            aria-labelledby="teamwork-tab">
                            <!-- <div class="d-flex justify-content-between align-items-center">
                                                            <h5>@lang('tentang_kami.laporan.button_bulanan')</h5>
                                                            <button class="btn btn-primary btn-laporan" data-tipe="bulan">@lang('tentang_kami.laporan.button_download')</button>
                                                        </div> -->
                            <!-- <canvas id="financialReportChartBulanan" width="400" height="200"></canvas> -->
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-success btn-laporan" data-tipe="bulan">
                                    @lang('tentang_kami.laporan.button_download_bulan')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- kelender -->
    @if($user->status_calendar == 1)
    <section class="section mb-2 mt-0" id="beranda-kalender">
        <div class="container px-2">
            <div class="d-flex flex-column justify-content-center align-items-center text-center">
                <h4 class="fs-1 fw-bold mb-4" style="font-family: Maven Pro, sans-serif">@lang('home.kalender.judul')</h4>
                <p class="mb-4 text-muted">@lang('home.kalender.sub_judul')</p>

                <div id="calendar" style="width: 100%; max-width: 800px; margin: 0 auto;"></div>
            </div>
        </div>
    </section> 
    @else
    <!-- sembunyikan -->
    @endif
@endsection


@push('modal')
    <!-- detail -->
    <!-- <div class="modal fade" id="modalShow" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div> -->

    <!-- kalender -->
    <div class="modal fade" id="modalCalendar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('home.close')</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="detail-popup" tabindex="-1"  data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-centered">
            <div class="modal-content rounded shadow border-0">
                <div class="modal-body p-4" style="max-height: 500px; overflow-y: auto;">
                    <!-- Konten modal di sini -->
                </div>
            </div>
        </div>
    </div>

@endpush

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        
        $(function() {     
            // kelender
            const calendarEl = document.getElementById('calendar')
            if (calendarEl) {
                $.ajax({
                    url: "{{ route('landing.chart.jadwal') }}",
                    type: 'Post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    success: function(response) {
                        const calendar = new FullCalendar.Calendar(calendarEl, {
                            height: 400,
                            // contentHeight: 600
                            initialView: 'dayGridMonth',
                            events: response,
                            eventTimeFormat: { // like '14:30'
                                hour: '2-digit',
                                minute: '2-digit',
                                meridiem: false // This removes the AM/PM notation
                            },
                            dateClick: function(info) {
                                $.ajax({
                                    url: "{{ route('landing.list.jadwal') }}",
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                                    },
                                    data: {
                                        date: info.dateStr
                                    },
                                    success: function(response) {
                                        if (response != "") {
                                            modalCalendar.find('.modal-title').html(
                                                '@lang('home.header_jadwal') - ' + info.dateStr
                                            );
                                            modalCalendar.find('.modal-body').html(response);
                                            modalCalendar.modal('show');
                                        }
                                    }
                                });
                            },
                            timeFormat: "H:mm",
                            slotLabelFormat: "HH:mm",
                        })
                        calendar.render()
                    }
                });
            }
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('financialReportChartBulanan').getContext('2d');
            var ctxTahun = document.getElementById('financialReportChartTahunan').getContext('2d');

            $.ajax({
                url: "{{ route('landing.chart.keuangan') }}",
                type: 'Post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                success: function(response) {
                    // tahunan
                    var financialReportChartTahunan = new Chart(ctxTahun, {
                        type: 'bar',
                        data: {
                            labels: response.tahun.categories,
                            datasets: [{
                                label: 'Laporan Keuangan Setiap Tahun',
                                data: response.tahun.series,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return value + '%';
                                        }
                                    }
                                }
                            }
                        }
                    });
                    // bulanan
                    var financialReportChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.bulan.categories,
                            datasets: [{
                                label: 'Laporan Keuangan Bulanan',
                                data: response.bulan.series,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return value + '%';
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            });
        });


        // variable set
        let btnProfile = $('.btn-profile')
        let btnLaporan = $('.btn-laporan')
        // let modalShow = $('#modalShow')
        let modalShow = $('#detail-popup')
        let modalCalendar = $('#modalCalendar')

        // event on click
        btnProfile.click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let url = "{{ route('profile', ':id') }}"
            url = url.replace(':id', id)

            $.ajax({
                type: "post",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                success: function(response) {
                    // $('.modal-title').html('Data Profile')
                    $('.modal-body').html(response)
                    modalShow.modal('show')
                },
                fail: function(err) {
                    console.log(err)
                }
            });
        })

        btnLaporan.click(function(e) {
            e.preventDefault();
            let tipe = $(this).attr('data-tipe');
            $.ajax({
                type: "post",
                url: "{{ route('landing.list.keuangan') }}",
                data: {
                    tipe: tipe
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                success: function(response) {
                    $('.modal-title').html('Data Laporan')
                    $('.modal-body').html(response)
                    modalShow.modal('show')
                },
            });
        })
        $(window).on('hashchange', function() {
            checkHash();
        });
        function checkHash(){
            var hash = window.location.hash;
            var locator = hash.substring(1);

            // Optionally scroll to the new hash element
            if (locator === "top-manajemen") {
                document.getElementById('top-management').scrollIntoView({ behavior: 'smooth' });
            }if (locator === "kepala-divisi") {
                document.getElementById('kepala-divisi').scrollIntoView({ behavior: 'smooth' });
            }if (locator === "struktur-organisasi") {
                document.getElementById('struktur-organisasi').scrollIntoView({ behavior: 'smooth' });
            }if (locator === "laporan-keuangan") {
                document.getElementById('laporan-keuangan').scrollIntoView({ behavior: 'smooth' });
            }if (locator === "about-us") {
                document.getElementById('about-us').scrollIntoView({ behavior: 'smooth' });
            }
        }
        checkHash();

        function checkScreenSize() {
            const images = document.querySelectorAll('.responsive-img');
            images.forEach((img) => {
                if (window.innerWidth >= 768 && window.innerWidth <= 1199) {
                    img.removeAttribute('style');
                } else {
                    img.style.height = '269.2px';
                }
            });
        }

        // Check screen size on page load
        document.addEventListener('DOMContentLoaded', checkScreenSize);

        // Check screen size on window resize
        window.addEventListener('resize', checkScreenSize);
    </script>
@endsection
