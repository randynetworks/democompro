@extends('landing.layouts.index')

@section('content')
    <!-- HEADER Start -->
    <!-- <section class=" d-table w-100 bg-half-260" style="background: url('landric/images/hosting/bg.png') center center;"> -->
    <section class=" d-table w-100 bg-half-260"
        style="background: url('{{ asset('images/image-header/' . $slider->gambar) }}'); height: 75vh; background-repeat: no-repeat; background-size: cover; background-position: center;">

        <div class="py-5 px-5">
            <div class="row mt-5 justify-content-center">
                <!-- <div class="col-lg-12 text-center">
                        <div class="pages-heading">
                            <h1 class="title mb-0 text-white">@lang('struktur_organisasi.heading')</h1>
                        </div>
                        <p class="description-text mt-3" style="font-family: Ubuntu, sans-serif; color: rgba(255, 255, 255, 1); font-size: 14px; font-weight: 400; line-height: 24.5px; max-width: 100%;">
                            @lang('struktur_organisasi.sub')
                        </p>
                    </div>  -->
            </div><!--end row-->

            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reindo Syariah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('struktur_organisasi.heading')</li>
                    </ul>
                </nav>
            </div>
        </div> <!--end container-->
    </section>

    <div class="position-relative bg-light">
        <div class="shape overflow-hidden text-color-white">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    @php
        $i = 1;
        $bg = 'bg-white';
    @endphp
    @foreach ($jabatans as $key => $value)
        @if ($i % 2 == 0)
            @php
                $bg = 'bg-white';
                $i++;
            @endphp
        @else
            @php
                $bg = 'bg-light';
                $i++;
            @endphp
        @endif
        <section class="section {{ $bg }} py-5">
            {{-- komisaris --}}
            <div class="px-5">
                <div class="d-flex flex-column justify-content-center align-items-center mb-4">
                    <h4 class="fs-1 text fw-bold" style="font-family: Maven Pro, sans-serif">
                        {{ $value->jabatan ?? '-' }}</h4>
                    {{-- <p class="mb-4 text-muted text-center">@lang('tentang_kami.jajaran0') {{ $value->jabatan }} @lang('tentang_kami.jajaran1')</p> --}}
                </div>
            </div>
            <div class="px-5">
                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                    @foreach ($stucture_organitations->whereHas('jabatan', fn($query) => $query->where('jabatan', $value->jabatan))->get() as $item)
                        <div class="col mb-4">
                            <div class="features feature-primary key-feature rounded shadow p-4 bg-white modal-profile"
                                style="cursor: pointer; height: 314.81px;" data-id="{{ $item->id }}">
                                <img src="{{ asset('images/jajaran-kami/' . $item?->gambar) }}" alt="Profile Image"
                                    class="img-fluid avatar avatar-medium rounded-circle mb-4">
                                <h4 class="mb-2">{{ $item->nama }}</h4>
                                @if (App::getLocale() == 'id')
                                    <h5 class="">{{ $item->tagline ?? '' }}</h5>
                                @elseif(App::getLocale() == 'en')
                                    <h5 class="">{{ $item->tagline_en ?? '' }}</h5>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach
@endsection

@push('modal')
    <div class="modal fade" id="modal-profile-body" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @lang('tentang_kami.header_modal')
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body data-profile"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        @lang('home.close')
                    </button>
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
        let modalProfile = $('.modal-profile')
        let modalProfileBody = $('#modal-profile-body')
        modalProfile.click(function(e) {
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

                    $('.data-profile').html(response)
                    modalProfileBody.modal('show')
                },
                fail: function(err) {
                    console.log(err)
                }
            });
        })
    </script>
@endsection
