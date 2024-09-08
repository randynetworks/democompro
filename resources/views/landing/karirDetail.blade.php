@extends('landing.layouts.index')

@section('content')
    <section class="d-table w-100 bg-half-260" style="background: url('{{ asset('images/image-header/' . $slider->gambar) }}'); height: 75vh; background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div class="py-5 px-5">
            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reindo Syariah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('layout.alert.karir')</li>
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
    <!--BERITA DAN ARTIKEL -->
    <section class="section">
        <div class="container">
            <div class="row mx-2 mb-2 justify-content-between">
                <div class="col-md-12 mb-5">
                    <a href="{{ route('karir') }}" class="btn btn-outline-primary"><i class="uil uil-angle-left-b"></i> @lang('berita_artikel.kembali') </a>

                    <div class="w-100 d-flex justify-content-between my-1 mt-4">
                        @if(App::getLocale() == 'id' )
                            <h1 class="">{{ $job->judul }}</h1>
                        @elseif(App::getLocale() != 'id' )
                            <h1 class="">{{ $job->judul_en }}</h1>
                        @endif
                    </div>
                    <p><i class="uil uil-calendar-alt text-dark h6 me-1"></i>{{ (new DateTime($job->created_at))->format('d F Y H:i:s') }}</p>
                    <div style="text-align: center;">
                        <img style="width: 50%; display: inline-block;" src="{{ asset('images/joblist/' . $job->gambar) }}" alt="{{ $job->gambar }}"
                            onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                    </div>
                    <div class="card h-100">
                        <div class=" d-flex flex-column">
                            @if(App::getLocale() == 'id' )
                                <p class="card-text">{!! $job->deskripsi !!}</p>
                            @elseif(App::getLocale() != 'id')
                                <p class="card-text">{!! $job->deskripsi_en !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        $('#selectCategory').select2()
    </script>
@endsection
