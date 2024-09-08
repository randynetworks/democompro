@extends('landing.layouts.index')
@section('styles')
    <style>
        .image {
            width: 60%;
        }

        .gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top right, rgba(66, 126, 186, 0.4), rgba(66, 126, 186, 1) 100%);
            pointer-events: none;
        }
    </style>
@endsection
@section('content')
    @php
        // $active = 'active';
        $beritaArtikelsPagination = 4;
    @endphp
    <!-- HEADER Start -->
    <section class="home-slider position-relative">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($landings as $key => $value)
                    <div class="carousel-item @if ($key == 0) active @endif" data-bs-interval="3000">
                        <div class="d-flex align-items-center justify-content-center w-100"
                            style="height: 100vh; background-repeat: no-repeat; background-size: cover; background-position: center; background-image: url('{{ asset('images/landing/' . $value->gambar) }}');">
                            <div class="container position-relative text-center" style="z-index: 2;">
                                <div class="d-flex justify-content-center align-items-center flex-column">
                                    <h1 class="fw-bold" style="font-family: Maven Pro, sans-serif; color: #ffffff">
                                        {{ $value->nama_perusahaan }}
                                    </h1>
                                    <p class="motto-text"
                                        style="font-family: Maven Pro, sans-serif; color: rgba(255, 255, 255, 1); font-size: 38px; font-weight: 400; line-height: 44.65px; letter-spacing: 0.015em;">
                                        {{ $value->motto }}</p>
                                    <p class="description-text"
                                        style="font-family: Ubuntu, sans-serif; color: rgba(255, 255, 255, 1); font-size: 14px; font-weight: 400; line-height: 24.5px; max-width: 100%;">
                                        {{ $value->deskripsi }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </section>

    {{-- <section class="section bg-light px-2 py-3"
        style="background-image: url('{{ asset('design/batik_kiri.png') }}');background-size: cover; background-position: center; background-repeat: no-repeat;"
        id="beranda-welcome">
        <div class="container">
            <div class="d-flex flex-column justify-content-center align-items-center">
                    <h4 class="fs-1 text fw-bold" style="font-family: Maven Pro, sans-serif">@lang('home.ucapan.judul')</h4>
                    <p class="mb-4 text-muted text-center" style="text-align: center;"><i>{!! $ucapans[0]->deskripsi !!}</i></p>

                    <img src="{{ asset('images/ucapan/' . $ucapans[0]->gambar) }}"
                        class="img-fluid avatar avatar-large rounded-circle mx-3 mb-4" style="object-fit: cover;">

                    <h4 class="fw-bold fs-4 mb-2">{{ $ucapans[0]->nama }}</h4>
                    <p class="fs-6 text text-muted">{{ $ucapans[0]->tagline }}</p>
            </div>
        </div>
    </section> --}}

    <!-- Managemnt Nilai -->
    @if ($user->status_nilai == 1)
        <section class="section" @unless ($nilais->isNotEmpty()) style="display:none;" @endunless>
            <style>
                @media (max-width: 768px) {
                    .bg-biru {
                        background-color: #427EBA !important;
                    }
                }
                @media (max-width: 912px) {
                    .bg-biru {
                        background-color: #427EBA !important;
                    }
                }
            </style>
            <div class="container">
                <div class="d-flex justify-content-center align-items-center py-1" style="height: 100%;">
                    <img src="{{ asset('images/nilai_by_gambar/' . $nilai_by_gambar->gambar) }}" class="img-fluid"
                        style="object-fit: cover; max-height: 400px;"
                        onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                </div>
            </div>
        </section>
    @elseif($user->status_nilai == 2)
        {{-- versi Dian --}}
        <section class="bg-light">
            <div class="container-fluid px-0">
                <div class="row g-0 align-items-center">
                    @foreach ($nilais as $key => $value)
                        <div class="col-xl-2 col-lg-4 col-md-4">
                            <div class="card features feature-primary feature-full-bg text-center rounded-0 px-4 py-4 bg-light bg-gradient position-relative overflow-hidden border-0" style="height: 228.79px;">
                                <!-- <span class="h3 icon-color">
                                    {{ substr($value->text, 0, 1) }}
                                </span> -->
                                <div style="text-align: center;" class="mb-2 mt-4">
                                    <img src="{{ asset('images/nilai_by_gambar/' . $value->gambar) }}" class="img- mb-2" alt="" style="width: 26px; height: 41px; display: inline-block;"
                                    onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                                </div>
                                <div class="card-body p-0 content">
                                    <h5>{{ $value->text ?? '' }}</h5>
                                    <p class="para text-muted mb-0">{{$value->deskripsi}}</p>
                                </div>
                            </div>
                        </div><!--end col-->
                    @endforeach

                </div><!--end row-->
            </div><!--end container-->
        </section>
    @endif

    <!-- SELAMAT DATANG -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6 col-12">
                    <img src="{{ asset('images/ucapan/' . $ucapans[0]->gambar) }}" class="img-fluid rounded" alt=""
                    onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                </div><!--end col-->

                <div class="col-lg-7 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="section-title ms-lg-4">
                        <h4 class="title mb-4 text-biru">ReIndo Syariah</h4>

                        <p class="text-muted">{!! $ucapans[0]->deskripsi !!}</p>
                        <p class="fs-6 text text-muted">{{ $ucapans[0]->nama }} - {{ $ucapans[0]->tagline }}</p>

                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--enc container-->
    </section>

    <!--BERITA DAN ARTIKEL -->
    {{-- <section class="section bg-hijau px-2 py-3" id="beranda-berita">
        <div class=" mt-0 px-2">
            <div class="row mt-0 mb-3 justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <p class="text-land fw-bold text-white"
                            style="font-family: Maven Pro, sans-serif; font-size: 30px;line-height: 1.5;">
                            @lang('home.berita_artikel.judul')
                        </p>
                        <p class="text-white">@lang('home.berita_artikel.sub_judul')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="carousel-berita" class="tiny-four-item">
                        @foreach ($beritaArtikels as $key => $value)
                            <div class="tiny-slide">
                                <div class="card border-0 text-center">
                                    <div class="position-relative overflow-hidden"
                                        style=" overflow: hidden; display: flex; justify-content: center; align-items: center;">
                                        <img src="{{ asset('images/berita_artikel/' . $value?->thumbnail) }}"
                                            style="object-fit: cover; height: 200px; width: 100%; max-height: 200px;"
                                            onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                                    </div>
                                    <div class="card-body text-start">
                                        <div class="title-heading">
                                            <h6>{{ Str::limit($value->judul, 40) }}
                                                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                                    href="{{ route('berita.artikel.defail', $value->slug) }}">
                                                    @lang('home.berita_artikel.button_lihat')
                                                </a>
                                            </h6>
                                        </div>
                                        <ul class="list-inline">
                                            <p class="mb-0"><i
                                                    class="uil uil-eye text-dark me-1"></i>{{ $value->total_kunjung }}</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item text-muted small me-3">
                                                    <i class="uil uil-calendar-alt text-dark h6 me-1"></i>
                                                    {{ \Carbon\Carbon::parse($value->created_at)->isoFormat('DD MMMM YYYY HH:mm:ss') }}
                                                </li>
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!--SERTIFIKAT -->
    {{-- <section class="section bg-light px-2 py-3" id="beranda-sertifikat">
        <div class="px-2 mt-0">
            <div class="row mt-0 mb-3 justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <p class="text-land"
                            style="font-family: Maven Pro, sans-serif; font-size: 30px; font-weight: 600; color:black;line-height: 1.5;">
                            @lang('home.sertifikat_prestasi.judul')</p>
                        <p style="color:#6D6D71">@lang('home.sertifikat_prestasi.sub_judul')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="carousel-sertifikat" class="tiny-four-item">
                        @foreach ($sertifikasis as $key => $value)
                            <a href="javascript:;" class="text-black btn-sertifikat" data-id="{{ $value->id }}">
                                <div class="tiny-slide">
                                    <div class="card border-0 text-center">
                                        <div class="position-relative overflow-hidden"
                                            style=" overflow: hidden; display: flex; justify-content: center; align-items: center;">
                                            <img src="{{ asset('images/sertifikat') . '/' . $value->gambar }}"
                                                style="object-fit: cover; height: 200px; width: 100%; max-height: 200px;"
                                                onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                                        </div>
                                        <div class="card-body text-start">
                                            @php
                                                $style_btn = 'bg-biru';
                                                if ($value->kategori == 2) {
                                                    $style_btn = 'bg-hijau';
                                                }
                                            @endphp

                                            <ul class="list-unstyled mb-2">
                                                <li class="list-inline-item text-muted small">
                                                    <span class="badge p-2 {{ $style_btn }}">
                                                        @if ($value->kategori == 1)
                                                            @lang('home.sertifikat')
                                                        @elseif ($value->kategori == 2)
                                                            @lang('home.prestasi')
                                                        @endif
                                                    </span>
                                                </li>
                                            </ul>
                                            <div class="title-heading">
                                                <h5>{{ Str::limit($value->nama, 20) }}</h5>
                                            </div>
                                            <ul class="list-inline">
                                                <li class="list-inline-item text-muted small me-3">
                                                    <i class="uil uil-calendar-alt text-dark h6 me-1"></i>
                                                    {{ \Carbon\Carbon::parse($value->waktu)->isoFormat('DD MMMM YYYY HH:mm:ss') }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- TATA KELOLA -->
    <!-- <section class="section px-2 py-3">
                                                                                <div class="py-5 px-2">
                                                                                    <div class="row">
                                                                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-stretch">
                                                                                            <div class="card mx-2 flex-1 bg-biru features key-feature">
                                                                                                <div class="card-body d-flex justify-content-center flex-column">
                                                                                                    <h4 class="mb-4 text fw-bold text-center text-white">@lang('home.tata_kelola.judul')</h4>
                                                                                                    <p class="mb-4 text-white text-center">@lang('home.tata_kelola.sub_judul')</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-stretch">
                                                                                            <div class="card mx-2 bg-hijau flex-1 features key-feature">
                                                                                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                                                                                    <h4 class="mb-4 text fw-bold text-center text-white">@lang('home.tata_kelola.card_tatakelola_judul')</h4>
                                                                                                    <p class="text-center text-white">@lang('home.tata_kelola.card_tatakelola_sub_judul')</p>
                                                                                                    <img src="images/beranda/tata_kelola.png"
                                                                                                        class="img-fluid avatar avatar-large rounded-circle mb-auto" alt="">
                                                                                                    <a href="" type="button" class="btn btn-success btn-management mt-3"
                                                                                                        data-tipe="tatakelola">@lang('home.tata_kelola.card_tatakelola_button')</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-stretch">
                                                                                            <div class="card mx-2 bg-biru-1 flex-1 features key-feature">
                                                                                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                                                                                    <h4 class="mb-4 text fw-bold text-center text-white">@lang('home.tata_kelola.card_kepatuhan_judul')</h4>
                                                                                                    <p class="text-center text-white">@lang('home.tata_kelola.card_kepatuhan_sub_judul')</p>
                                                                                                    <img src="images/beranda/kepatuhan.png"
                                                                                                        class="img-fluid avatar avatar-large rounded-circle mb-auto" alt="">
                                                                                                    <a href="" type="button" class="btn btn-success btn-management mt-3"
                                                                                                        data-tipe="resiko">@lang('home.tata_kelola.card_kepatuhan_button')</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </section> -->

    {{-- NEW Informasi & Media --}}
    <div class="position-relative">
        <div class="shape overflow-hidden text-footer ">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="white"></path>
            </svg>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row align-items-end mb-4 pb-4">
                <div class="col-lg-12">
                    <div class="section-title text-center text-md-start">
                        <h4 class="title mb-2 text-primary">@lang('home.info.judul')</h4>
                        <!-- <p class="text-muted mb-0 para-desc">@lang('home.info.sub1') <span
                                class="text-primary fw-bold">ReindoSyariah</span>. @lang('home.info.sub2')</p> -->
                    </div>
                </div><!--end row-->

                <div class="row">
                    <div class="col-md-4 mt-4 pt-2">
                        <ul class="nav nav-pills nav-justified flex-column rounded shadow p-3 mb-0 sticky-bar"
                            id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link rounded active" id="webdeveloping" data-bs-toggle="pill"
                                    href="#developing" role="tab" aria-controls="developing" aria-selected="false"
                                    tabindex="-1">
                                    <div class="text-center py-1">
                                        <h6 class="mb-0">@lang('home.info.berita')</h6>
                                    </div>
                                </a><!--end nav link-->
                            </li><!--end nav item-->

                            <li class="nav-item mt-2" role="presentation">
                                <a class="nav-link rounded" id="database" data-bs-toggle="pill" href="#data-analise"
                                    role="tab" aria-controls="data-analise" aria-selected="false" tabindex="-1">
                                    <div class="text-center py-1">
                                        <h6 class="mb-0">@lang('home.info.artikel')</h6>
                                    </div>
                                </a><!--end nav link-->
                            </li><!--end nav item-->

                            <li class="nav-item mt-2" role="presentation">
                                <a class="nav-link rounded" id="server" data-bs-toggle="pill" href="#security"
                                    role="tab" aria-controls="security" aria-selected="false" tabindex="-1">
                                    <div class="text-center py-1">
                                        <h6 class="mb-0">@lang('home.info.sertifikasi')</h6>
                                    </div>
                                </a><!--end nav link-->
                            </li><!--end nav item-->

                            <li class="nav-item mt-2" role="presentation">
                                <a class="nav-link rounded" id="server2" data-bs-toggle="pill" href="#security2"
                                    role="tab" aria-controls="security2" aria-selected="false" tabindex="-1">
                                    <div class="text-center py-1">
                                        <h6 class="mb-0">@lang('home.info.penghargaan')</h6>
                                    </div>
                                </a><!--end nav link-->
                            </li><!--end nav item-->

                            <li class="nav-item mt-2" role="presentation">
                                <a class="nav-link rounded" id="server3" data-bs-toggle="pill" href="#security3"
                                    role="tab" aria-controls="security3" aria-selected="false" tabindex="-1">
                                    <div class="text-center py-1">
                                        <h6 class="mb-0">@lang('home.info.dokumentasi')</h6>
                                    </div>
                                </a><!--end nav link-->
                            </li><!--end nav item-->

                            <li class="nav-item mt-2" role="presentation">
                                <a class="nav-link rounded" id="server4" data-bs-toggle="pill" href="#security4"
                                    role="tab" aria-controls="security4" aria-selected="false" tabindex="-1">
                                    <div class="text-center py-1">
                                        <h6 class="mb-0">@lang('layout.alert.video')</h6>
                                    </div>
                                </a>
                            </li>

                            <li class="nav-item mt-2" role="presentation">
                                <a class="nav-link rounded" id="server5" data-bs-toggle="pill" href="#security5"
                                    role="tab" aria-controls="security5" aria-selected="false" tabindex="-1">
                                    <div class="text-center py-1">
                                        <h6 class="mb-0">@lang('layout.alert.karir')</h6>
                                    </div>
                                </a>
                            </li>
                        </ul><!--end nav pills-->
                    </div><!--end col-->

                    <div class="col-md-8 col-12 mt-4 pt-2">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade p-4 rounded shadow active show" id="developing" role="tabpanel"
                                aria-labelledby="webdeveloping">
                                @if($lastBerita != null)
                                <img src="{{ asset('images/berita_artikel/' . $lastBerita->thumbnail) }}"
                                    style="object-fit: cover"
                                    onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';"
                                    class="img-fluid rounded shadow" alt="">
                                <div class="mt-4">
                                    <p class="text-muted">{{ $lastBerita->judul ?? '' }}</p>
                                    <a href="{{ route('berita') }}" class="text-primary">@lang('home.info.see') <i
                                            class="uil uil-angle-right-b align-middle"></i></a>
                                </div>
                                @else
                                <!-- <img src="{{ asset('images/no-image.png') }}"
                                    style="object-fit: cover"
                                    class="img-fluid rounded shadow" alt="No Image Available"> -->
                                <div class="text-center">
                                    <div class="icon d-flex align-items-center justify-content-center bg-soft-primary rounded-circle mx-auto" style="height: 90px; width:90px;">
                                        <i class="uil uil-hourglass align-middle h1 mb-0"></i>
                                    </div>
                                    <h5 class="my-4 fw-bold">@lang('layout.alert.text1') @lang('layout.alert.berita') @lang('layout.alert.text2')</h5>
                                </div>
                                @endif
                            </div><!--end teb pane-->

                            <div class="tab-pane fade p-4 rounded shadow" id="data-analise" role="tabpanel"
                                aria-labelledby="database">
                                @if($lastArtikel != null)
                                <img src="{{ asset('images/berita_artikel/' . $lastArtikel->thumbnail) }}"
                                    style="object-fit: cover"
                                    onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';"
                                    class="img-fluid rounded shadow" alt="">
                                
                                <div class="mt-4">
                                    <p class="text-muted">{{ $lastArtikel->judul ?? '' }}</p>
                                    <a href="{{ route('artikel') }}" class="text-primary">@lang('home.info.see') <i
                                            class="uil uil-angle-right-b align-middle"></i></a>
                                </div>
                                @else
                                <!-- <img src="{{ asset('images/no-image.png') }}"
                                    style="object-fit: cover"
                                    class="img-fluid rounded shadow" alt="No Image Available"> -->
                                <div class="text-center">
                                    <div class="icon d-flex align-items-center justify-content-center bg-soft-primary rounded-circle mx-auto" style="height: 90px; width:90px;">
                                        <i class="uil uil-hourglass align-middle h1 mb-0"></i>
                                    </div>
                                    <h5 class="my-4 fw-bold">@lang('layout.alert.text1') @lang('layout.alert.artikel') @lang('layout.alert.text2')</h5>
                                </div>
                                @endif
                            </div><!--end teb pane-->

                            <div class="tab-pane fade p-4 rounded shadow" id="security" role="tabpanel"
                                aria-labelledby="server">
                                @if($lastSertifikat !=  null)
                                <img src="{{ asset('images/sertifikat/' . $lastSertifikat->gambar) }}"
                                    style="object-fit: cover"
                                    onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';"
                                    class="img-fluid rounded shadow" alt="">
                                
                                <div class="mt-4">
                                    <p class="text-muted">{{ $lastSertifikat->nama ?? '' }}</p>
                                    <a href="{{ route('sertifikasi') }}" class="text-primary">@lang('home.info.see') <i
                                            class="uil uil-angle-right-b align-middle"></i></a>
                                </div>
                                @else
                                <!-- <img src="{{ asset('images/no-image.png') }}"
                                    style="object-fit: cover"
                                    class="img-fluid rounded shadow" alt="No Image Available"> -->
                                <div class="text-center">
                                    <div class="icon d-flex align-items-center justify-content-center bg-soft-primary rounded-circle mx-auto" style="height: 90px; width:90px;">
                                        <i class="uil uil-hourglass align-middle h1 mb-0"></i>
                                    </div>
                                    <h5 class="my-4 fw-bold">@lang('layout.alert.text1') @lang('layout.alert.sertifikasi') @lang('layout.alert.text2')</h5>
                                </div>
                                @endif
                            </div><!--end teb pane-->

                            <div class="tab-pane fade p-4 rounded shadow" id="security2" role="tabpanel"
                                aria-labelledby="server2">
                                @if($lastPenghargaan != null)
                                <img src="{{ asset('images/sertifikat/' . $lastPenghargaan->gambar) }}"
                                    style="object-fit: cover"
                                    onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';"
                                    class="img-fluid rounded shadow" alt="">
                                
                                <div class="mt-4">
                                    <p class="text-muted">{{ $lastPenghargaan->nama ?? '' }}</p>
                                    <a href="{{ route('penghargaan') }}" class="text-primary">@lang('home.info.see') <i
                                            class="uil uil-angle-right-b align-middle"></i></a>
                                </div>
                                @else
                                <!-- <img src="{{ asset('images/no-image.png') }}"
                                    style="object-fit: cover"
                                    class="img-fluid rounded shadow" alt="No Image Available"> -->
                                <div class="text-center">
                                    <div class="icon d-flex align-items-center justify-content-center bg-soft-primary rounded-circle mx-auto" style="height: 90px; width:90px;">
                                        <i class="uil uil-hourglass align-middle h1 mb-0"></i>
                                    </div>
                                    <h5 class="my-4 fw-bold">@lang('layout.alert.text1') @lang('layout.alert.penghargaan') @lang('layout.alert.text2')</h5>
                                </div>
                                @endif
                            </div><!--end teb pane-->

                            <div class="tab-pane fade p-4 rounded shadow" id="security3" role="tabpanel"
                                aria-labelledby="server3">
                                @if($lastKegiatan != null)
                                <img src="{{ asset('images/dokumentasi/' . $lastKegiatan->gambar) }}"
                                    style="object-fit: cover"
                                    onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';"
                                    class="img-fluid rounded shadow" alt="">
                                
                                <div class="mt-4">
                                    <p class="text-muted">{{ $lastKegiatan->text ?? '' }}</p>
                                    <a href="{{ route('kegiatan') }}" class="text-primary">@lang('home.info.see') <i
                                            class="uil uil-angle-right-b align-middle"></i></a>
                                </div>
                                @else
                                <!-- <img src="{{ asset('images/no-image.png') }}"
                                    style="object-fit: cover"
                                    class="img-fluid rounded shadow" alt="No Image Available"> -->
                                <div class="text-center">
                                    <div class="icon d-flex align-items-center justify-content-center bg-soft-primary rounded-circle mx-auto" style="height: 90px; width:90px;">
                                        <i class="uil uil-hourglass align-middle h1 mb-0"></i>
                                    </div>
                                    <h5 class="my-4 fw-bold">@lang('layout.alert.text1') @lang('layout.alert.dokumentasi') @lang('layout.alert.text2')</h5>
                                </div>
                                @endif
                            </div><!--end teb pane-->

                            <div class="tab-pane fade p-4 rounded shadow" id="security4" role="tabpanel"
                                aria-labelledby="server4">
                                @if(isset($podcast))
                                <div class="embed-responsive embed-responsive-16by9"
                                    style="height: 0; overflow: hidden; position: relative; padding-bottom: 56.25%; padding-top: 30px; height: 0; overflow: hidden;">
                                    <!-- <iframe class="embed-responsive-item" src="{{ $podcast->youtube_link_embed }}" allowfullscreen
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe> -->
                                    @if(isset($podcast->youtube_link_embed) && !empty($podcast->youtube_link_embed))
                                        <iframe class="embed-responsive-item" src="{{ $podcast->youtube_link_embed }}" allowfullscreen
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                                    @elseif(isset($podcast->video_file) && !empty($podcast->video_file))
                                    <video controls style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" >
                                        <source src="{{ asset('/images/podcast/' . $podcast->video_file) }}" type="video/mp4">
                                    </video>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <p class="text-muted">{{ $podcast->judul ?? '' }}</p>
                                    <a href="{{ route('videos') }}" class="text-primary">@lang('home.info.see') <i
                                            class="uil uil-angle-right-b align-middle"></i></a>
                                </div>
                                @else
                                    <div class="text-center">
                                        <div class="icon d-flex align-items-center justify-content-center bg-soft-primary rounded-circle mx-auto" style="height: 90px; width:90px;">
                                            <i class="uil uil-hourglass align-middle h1 mb-0"></i>
                                        </div>
                                        <h5 class="my-4 fw-bold">@lang('layout.alert.text1') @lang('layout.alert.video') @lang('layout.alert.text2')</h5>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade p-4 rounded shadow" id="security5" role="tabpanel"
                                aria-labelledby="server5">
                                @if($lastKarir != null)
                                <img src="{{ asset('images/joblist/' . $lastKarir->gambar) }}"
                                    style="object-fit: cover"
                                    onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';"
                                    class="img-fluid rounded shadow" alt="">
                                
                                <div class="mt-4">
                                    <p class="text-muted">{{ $lastKarir->judul ?? '' }}</p>
                                    <a href="{{ route('karir') }}" class="text-primary">@lang('home.info.see') <i
                                            class="uil uil-angle-right-b align-middle"></i></a>
                                </div>
                                @else
                                <div class="text-center">
                                    <div class="icon d-flex align-items-center justify-content-center bg-soft-primary rounded-circle mx-auto" style="height: 90px; width:90px;">
                                        <i class="uil uil-hourglass align-middle h1 mb-0"></i>
                                    </div>
                                    <h5 class="my-4 fw-bold">@lang('layout.alert.text1') @lang('layout.alert.karir') @lang('layout.alert.text2')</h5>
                                </div>
                                @endif
                            </div><!--end teb pane-->
                        </div><!--end tab content-->
                    </div><!--end col-->
                </div><!--end row-->
            </div>
    </section>

    <!--DOKUMENTASI KEGIATAN -->
    {{-- <section class="section bg-biru-1 px-2 py-3" id="beranda-kegiatan">
        <div class="mt-100 mt-40 px-2">
            <div class="row mt-3 mb-3 justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h4 class="mb-4 fs-1 text-white fw-bold" style="font-family: Maven Pro, sans-serif">
                            @lang('home.dokumentasi.judul')
                        </h4>
                        <p class="mb-4 text-white">@lang('home.dokumentasi.sub_judul')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ">
                    <div id="carousel-dokumentasi" class="tiny-four-item"
                        style="margin: 0 auto; display: flex; justify-content: center;">
                        @foreach ($dokumentasi as $key => $value)
                            <a href="javascript:;" class="text-black btn-dokumentasi" data-id="{{ $value->id }}"
                                target="blank">
                                <div class="tiny-slide">
                                    <div class="card border-0 text-center">
                                        <div class="position-relative overflow-hidden"
                                            style=" overflow: hidden; display: flex; justify-content: center; align-items: center;">
                                            <img src="{{ asset('images/dokumentasi') . '/' . $value->gambar }}"
                                                style="object-fit: cover; height: 200px; width: 100%; max-height: 200px;"
                                                onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                                        </div>
                                        <div class="card-body text-start">
                                            <ul class="list-unstyled mb-2">
                                                <li class="list-inline-item text-muted small"
                                                    style="background-color:rgba(53, 171, 73, 0.58); border-radius:6px;">
                                                    <span class="badge p-2" style="color: rgba(62, 129, 64, 1)">
                                                        @if ($value->kategori == 1)
                                                            @lang('home.sosial')
                                                        @elseif ($value->kategori == 2)
                                                            @lang('home.acara')
                                                        @endif
                                                    </span>
                                                </li>
                                            </ul>
                                            <div class="title-heading">
                                                <h5>{{ Str::limit($value->text, 20) }}</h5>
                                            </div>
                                            <ul class="list-inline">
                                                <li class="list-inline-item text-muted small me-3">
                                                    <i class="uil uil-calendar-alt text-dark h6 me-1"></i>
                                                    {{ \Carbon\Carbon::parse($value->waktu)->isoFormat('DD MMMM YYYY HH:mm:ss') }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- KALENDER -->
    {{-- <section class="section py-3 px-2" id="beranda-kalender">
        <div class="mt-100 mt-40 px-2">
            <div class="d-flex flex-column justify-content-center align-items-center text-center">
                <h4 class="fs-1 fw-bold" style="font-family: Maven Pro, sans-serif">@lang('home.kalender.judul')</h4>
                <p class="mb-4 text-muted">@lang('home.kalender.sub_judul')</p>

                <div id="calendar" style="width: 100%; max-width: 1000px; margin: 0 auto; height: auto;"></div>
            </div>
        </div>
    </section> --}}
@endsection

@push('modal')
    <div class="modal fade" id="modalShow" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <span class="fw-bold title-management"></span>
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <form action="javascript:;" method="POST" id="form">
                    <div class="modal-body">
                        <input type="hidden" name="kategori" id="kategori">
                        <div class="mb-3">
                            <label for="name" class="form-label">@lang('home.nama')</label>
                            <input type="text" class="form-control" name="nama" id="nama"
                                placeholder='@lang('home.nama')' />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email"
                                placeholder="Email" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('home.close')</button>
                        <button type="submit" class="btn btn-primary btn-submit">
                            @lang('home.submit')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    <div class="modal fade" id="modalShow_sertifikat" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @lang('home.modal_sertifikat')
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body-sertifikasi"></div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalShow_dokumentasi" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @lang('home.modal_dokumentasi')
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body-dokumentasi"></div>
            </div>
        </div>
    </div>
@endpush

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
        })

        // variable
        let btnManagement = $('.btn-management')
        let modalShow = $('#modalShow')
        let modalCalendar = $('#modalCalendar')
        let form = $('#form')

        // event on click
        btnManagement.click(function(e) {
            e.preventDefault();
            $('input').val('')
            let tipe = $(this).attr('data-tipe');
            let title = $('.title-management')
            let value = tipe == "tatakelola" ? '@lang('home.modal_tatakelola')' : '@lang('home.modal_kepatuhan')'
            title.html(value)
            $('#kategori').val(tipe)
            modalShow.modal('show')
        })

        form.submit(function(e) {
            e.preventDefault()
            let data = form.serialize()
            $.ajax({
                type: 'POST',
                url: "{{ route('landing.download.tatakelola') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                data: data,
                success: function(response) {
                    modalShow.modal('hide');
                    Swal.fire('Berhasil', 'Kamu Berhasil Mengunduh File', 'success').then(() => {
                        let url = "{{ route('landing.download.tatakelola.file', ':id') }}"
                        url = url.replace(':id', $('#kategori').val())
                        window.open(url, "_blank");
                    });
                },
                error: function(xhr, status, error) {
                    if (xhr.status == 422) { // when status code is 422, it's a validation issue
                        console.log(xhr.responseJSON);
                        $('.validate-error').remove();

                        // display errors on each form field
                        $.each(xhr.responseJSON.errors, function(i, error) {
                            var el = $('[name="' + i + '"]');
                            el.after($('<span class="validate-error" style="color: red;">' +
                                error[0] +
                                '</span>'));
                        });
                    }
                }
            });
        })

        // Calendar Event

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar')
            if (calendarEl) {
                $.post("{{ route('landing.chart.jadwal') }}", '').then((response) => {
                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        events: response,
                        eventTimeFormat: { // like '14:30'
                            hour: '2-digit',
                            minute: '2-digit',
                            meridiem: false // This removes the AM/PM notation
                        },
                        dateClick: function(info) {
                            $.post("{{ route('landing.list.jadwal') }}", {
                                date: info.dateStr
                            }).then((response) => {
                                if (response != "") {
                                    modalCalendar.find('.modal-title').html(
                                        '@lang('home.header_jadwal') - ' + info.dateStr)
                                    modalCalendar.find('.modal-body').html(response)
                                    modalCalendar.modal('show')
                                }
                            })
                        },
                        timeFormat: "H:mm",
                        slotLabelFormat: "HH:mm",
                    })
                    calendar.render()
                });

            }
        })

        // modal sertifikat detail
        let btnSerfifikat = $('.btn-sertifikat')
        let modalShow_sertifikat = $('#modalShow_sertifikat')

        btnSerfifikat.click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let url = "{{ route('sertifikat.detail', ':id') }}"
            url = url.replace(':id', id)
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                success: function(response) {
                    $('.modal-body-sertifikasi').html(response)
                    modalShow_sertifikat.modal('show')
                },
                fail: function(err) {
                    console.log(err)
                }
            });
        })

        // modal dokumentasi detail
        let btnDokumentasi = $('.btn-dokumentasi')
        let modalShow_dokumentasi = $('#modalShow_dokumentasi')

        btnDokumentasi.click(function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let url = "{{ route('dokumentasi.detail', ':id') }}"
            url = url.replace(':id', id)
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                success: function(response) {
                    $('.modal-body-dokumentasi').html(response)
                    modalShow_dokumentasi.modal('show')
                },
                fail: function(err) {
                    console.log(err)
                }
            });
        })
    </script>
@endsection
