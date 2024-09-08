@extends('landing.layouts.index')

@section('content')
    <!-- Jumbotron -->
    <section class=" d-table w-100 bg-half-260" style="background: url('{{ asset('images/image-header/' . $slider->gambar) }}'); height: 75vh; background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div class="py-5 px-5">
            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reindo Syariah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('layout.media.sertifikasi')</li>
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

    {{-- Sertifikasi --}}
    <section class="section py-5 ">
        <div class="container">
            <div class="row mb-5 justify-content-lg-end justify-content-center p-2">
                <div class="col-lg-3 col-md-6 mb-3 mb-md-0" style="display: none">
                    <div class="input-group">
                        <!-- <span class="input-group-text">
                            <i class="bi bi-calendar2-week fs-7 align-items-center"></i>
                        </span>
                        <select class="form-select" data-control="select2" data-hide-search="true" name="tahun" id="tahun" onchange="filter_sertifikat();">
                            @foreach ($filter_tahun as $tahun)
                                <option value="{{ $tahun }}" {{ $tahun == date('Y') ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search fs-7 align-items-center"></i>
                        </span>
                        <input type="text" id="search" class="form-control" onkeyup="filter_sertifikat()" onkeydown="filter_sertifikat()" placeholder="Search..." autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row mx-5 mb-2" id="sertifikat-container">
            </div>
            <div class="pagination-container text-center mt-4 d-flex justify-content-center" id="paginationContainer">
                <!-- Pagination controls will be appended here -->
            </div>

            <!-- no konten -->
            <div class="container" id="no-data-section" style="display: none;">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="text-center">
                            <div class="icon d-flex align-items-center justify-content-center bg-soft-primary rounded-circle mx-auto" style="height: 90px; width:90px;">
                                <i class="uil uil-hourglass align-middle h1 mb-0"></i>
                            </div>
                            <h5 class="my-4 fw-bold">@lang('layout.alert.text1') @lang('layout.alert.sertifikasi') @lang('layout.alert.text2')</h5>
                            <a href="{{ url('/') }}" class="btn btn-soft-primary mt-3">@lang('layout.alert.kembali')</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('modal')
    <div class="modal fade" id="modalShow" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title">
                    @lang('home.modal_sertifikat')
                    </h5> -->
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
@endpush

@section('scripts')
    <script>

        $(function() {
            sertifikat();
        });
        jQuery.noConflict();

        function sertifikat(search, page) {
            var beritaContainer = $('#sertifikat-container');
            var noDataSection = $('#no-data-section');
            $.ajax({
                url: "{{ route('sertifikasi.json.sertifikasi') }}?search=" + search + "&page=" + page,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var data = response;
                    if(data.total != 0){
                        displayDataInBlade(data);
                        updatePagination(response);
                        noDataSection.hide();
                        beritaContainer.show();
                    }else{                    
                        beritaContainer.hide();
                        noDataSection.show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    beritaContainer.hide();
                    noDataSection.show();
                }
            });
            //event.preventDefault();
        }

        function filter_sertifikat() {
            // var tahun = document.getElementById('tahun');
            var search = $("#search").val();
            var page = 1;
            sertifikat(search, page);
        }

        function updatePagination(response) {
            var paginationContainer = $('#paginationContainer');
            paginationContainer.empty();

            var currentScrollPosition = $(window).scrollTop();

            var currentPage = response.current_page;
            var lastPage = response.last_page;

            if (lastPage > 1) {
                var paginationHtml = '<ul class="pagination">';

                // Previous page link
                if (currentPage > 1) {
                    paginationHtml += '<li class="page-item"><a class="page-link" href="#" onclick="sertifikat(\'' + response.text + '\', ' + (currentPage - 1) + ')">Previous</a></li>';
                }

                // Page links
                for (var i = 1; i <= lastPage; i++) {
                    paginationHtml += '<li class="page-item ' + (i === currentPage ? 'active' : '') + '"><a class="page-link" href="#" onclick="sertifikat(\'' + response.text + '\', ' + i + ')">' + i + '</a></li>';
                }

                // Next page link
                if (currentPage < lastPage) {
                    paginationHtml += '<li class="page-item"><a class="page-link" href="#" onclick="sertifikat(\'' + response.text + '\', ' + (currentPage + 1) + ')">Next</a></li>';
                }

                paginationHtml += '</ul>';
                paginationContainer.append(paginationHtml);

                // Atur ulang posisi scroll setelah pembuatan pagination selesai
                $(window).scrollTop(currentScrollPosition);
            }
        }

        function displayDataInBlade(data) {
            var dataJson = JSON.stringify(data);
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: "{{ route('sertifikasi.blade') }}",
                data: { data: dataJson }, // Kirim data ke Blade
                success: function(response) {
                    $('#sertifikat-container').html(response); // Tampilkan hasil dari Blade
                },
                error: function(xhr, status, error) {
                    console.error('Error displaying data in Blade:', error);
                }
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
