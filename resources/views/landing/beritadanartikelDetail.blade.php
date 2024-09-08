@extends('landing.layouts.index')

@push('meta')
    <meta property="og:title" content="{{ $berita->judul }}">
    <meta property="og:description" content="{{ $berita->isi_berita }}">
    <meta property="og:image" content="{{ asset('/images/berita_artikel/' . $berita->thumbnail) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
@endpush

@section('content')
    <section class="d-table w-100 bg-half-260" style="background: url('{{ asset('images/image-header/' . $slider->gambar) }}'); height: 75vh; background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div class="py-5 px-5">
            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reindo Syariah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Berita</li>
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
                <div class="col-md-8 mb-5">
                    <a href="{{ $berita->kategori == 1 ? route('berita') : route('artikel') }}" class="btn btn-outline-primary"><i class="uil uil-angle-left-b"></i> @lang('berita_artikel.kembali') </a>

                    <div class="w-100 d-flex justify-content-between my-1 mt-4">
                        @if(App::getLocale() == 'id' )
                            <h1 class="">{{ $berita->judul }}</h1>
                        @elseif(App::getLocale() != 'id' )
                            <h1 class="">{{ $berita->judul_en }}</h1>
                        @endif
                    </div>
                    <div class="w-100 d-flex justify-content-between my-1 mt-1">
                        @php
                            $style_btn = 'bg-biru';
                            if ($berita->kategori == 2) {
                                $style_btn = 'bg-hijau';
                            }
                        @endphp
                        <span class="badge p-2 {{ $style_btn }}">
                            @if ($berita->kategori == 1)
                                @lang('berita_artikel.badge_berita')
                            @elseif ($berita->kategori == 2)
                                @lang('berita_artikel.badge_artikel')
                            @endif
                        </span>
                    </div>
                    <p><i class="uil uil-calendar-alt text-dark h6 me-1"></i>{{ (new DateTime($berita->waktu))->format('d F Y H:i:s') }}</p>
                    <div style="text-align: center;">
                        <img style="width: 50%; display: inline-block;" src="{{ asset('images/berita_artikel/' . $berita?->thumbnail) }}" alt="{{ $berita?->thumbnail }}"
                            onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                    </div>
                    <div class="card h-100">
                        <div class=" d-flex flex-column">
                            @if(App::getLocale() == 'id' )
                                <p class="card-text">{!! $berita->isi_berita !!}</p>
                            @elseif(App::getLocale() != 'id')
                                <p class="card-text">{!! $berita->isi_berita_en !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <h4 class="text-muted">@lang('berita_artikel.post')</h4>
                    <br>
                    <div class="d-flex flex-column align-items-center">
                        @foreach ($randomBerita as $item)
                            <div class="card text-start my-2">
                                <a href="{{ route('berita.artikel.defail', $item->slug) }}"
                                    style="display: flex !important; flex-direction: row !important; align-items: center !important;text-decoration: none">
                                    <img style="width: 20%;height: 20%;"
                                        src="{{ asset('images/berita_artikel') . '/' . $item->thumbnail }}"
                                        alt="{{ $item->thumbnail }}" />
                                    <div class="card-body">
                                        <h4 class="card-title text-dark">
                                            @if(App::getLocale() == 'id' )
                                                {{ Str::limit($item->judul, 50) }}
                                            @elseif(App::getLocale() != 'id')
                                                {{ Str::limit($item->judul_en, 50) }}
                                            @endif
                                        </h4>
                                        <p class="text-muted"><i class="uil uil-calendar-alt text-dark h6 me-1"></i>{{ (new DateTime($item->waktu))->format('d F Y H:i:s') }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
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
