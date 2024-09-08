@extends('landing.layouts.index')
@section('content')
    <section class=" d-table w-100 bg-half-260" style="background: url('{{ asset('images/landing/' . $slider->gambar) }}'); height: 75vh; background-repeat: no-repeat; background-size: cover; background-position: center;">

        <div class="py-5 px-5">
            <div class="row mt-5 justify-content-center">
                <!-- <div class="col-lg-12 text-center">
                    <div class="pages-heading">
                        <h1 class="title mb-0 text-white">{{$content->navbar}}</h1>
                    </div>
                    <p class="description-text mt-3" style="font-family: Ubuntu, sans-serif; color: rgba(255, 255, 255, 1); font-size: 14px; font-weight: 400; line-height: 24.5px; max-width: 100%;">
                    {{$content->deskripsi}}
                    </p>
                </div> -->
            </div>
            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reindo Syariah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$content->navbar}}</li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <div class="position-relative">
        <div class="shape overflow-hidden text-color-white">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- disini -->
    <div class="content">
        <section class="section py-5 px-5">
            <div class="py-5 px-5">
                {!! $body !!}
            </div>
        </div>
    </div>
@endsection
