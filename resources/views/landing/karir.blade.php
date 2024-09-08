@extends('landing.layouts.index')
@section('content')
    <section class=" d-table w-100 bg-half-260"
        style="background: url('{{ asset('images/image-header/' . $slider->gambar) }}'); height: 75vh; background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div class="bg-overlay bg-biru opacity-2"></div>
        <div class="py-5 px-5">
            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reindo Syariah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('layout.karir.nav')</li>
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

    <!-- BERKARIR BERSAMA KAMI -->
    <div class="position-relative">
        <div class="shape overflow-hidden text-footer ">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="#f8f9fa"></path>
            </svg>
        </div>
    </div>
    <section class="section bg-light" id="beranda-karir">
        <div class="container">
            <style>
                .section.bg-biru-1 .container .d-flex {
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                    text-align: center;
                }

                .section.bg-biru-1 .container .d-flex img {
                    max-width: 100%;
                    height: auto;
                    margin-bottom: 1rem;
                }

                .section.bg-biru-1 .container .d-flex .title-heading {
                    text-align: center;
                    margin-bottom: 1rem;
                }

                @media (max-width: 767.98px) {
                    .section.bg-biru-1 .container .d-flex {
                        flex-direction: column;
                        align-items: center;
                    }

                    .section.bg-biru-1 .container .d-flex img {
                        order: -1;
                        margin-bottom: 1rem;
                    }

                    .section.bg-biru-1 .container .d-flex .title-heading {
                        order: 0;
                        text-align: center;
                    }
                }
            </style>
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h4 class="title mb-4">@lang('home.karir.judul')</h4>
                        <p class="text-muted para-desc mx-auto">@lang('home.karir.sub_judul')</p>
                        <a href="{{ $lowongan }}" class="btn bg-hijau mt-4 text-white" target="_blank">
                            @lang('home.karir.button')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DAFTAR LOWONGAN -->
    <section class="section py-5">
        <div class="container">
            <div class="row mb-5 justify-content-lg-end justify-content-center p-2">
                <div class="col-lg-4 col-md-6 mb-3 mb-md-0" style="display: none">
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search fs-7 align-items-center"></i>
                        </span>
                        <input type="text" id="search" class="form-control" onkeyup="filter_job()" onkeydown="filter_job()" placeholder="Search..." autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row mx-5 mb-2 align-items-scretch" id="job-container">

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
                            <h5 class="my-4 fw-bold">@lang('layout.alert.text1') @lang('layout.alert.karir') @lang('layout.alert.text2')</h5>
                            <a href="{{ url('/') }}" class="btn btn-soft-primary mt-3">@lang('layout.alert.kembali')</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection


@section('scripts')
<script>
    jQuery.noConflict();

	$(function() {
        job();
    });

    function job(search, page) {
        var jobContainer = $('#job-container');
        var noDataSection = $('#no-data-section');
        $.ajax({
            url: "{{ route('karir.json') }}?search=" + search + "&page=" + page,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var data = response;
                if(data.total != 0){
                    displayDataInBlade(data);
                    updatePagination(response);
                    noDataSection.hide();
                    jobContainer.show();
                }else{                    
                    jobContainer.hide();
                    noDataSection.show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                jobContainer.hide();
                noDataSection.show();
            }
        });
    }

    function filter_job() {
        // var datePicker = $("#date-picker").val();
        var search = $("#search").val();
        var page = 1;
        job(search, page);
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
                paginationHtml += '<li class="page-item"><a class="page-link" href="#" onclick="job(\'' + response.text + '\', ' + (currentPage - 1) + ')">Previous</a></li>';
            }
            // Page links
            for (var i = 1; i <= lastPage; i++) {
                paginationHtml += '<li class="page-item ' + (i === currentPage ? 'active' : '') + '"><a class="page-link" href="#" onclick="job(\'' + response.text + '\', ' + i + ')">' + i + '</a></li>';
            }
            // Next page link
            if (currentPage < lastPage) {
                paginationHtml += '<li class="page-item"><a class="page-link" href="#" onclick="job(\'' + response.text + '\', ' + (currentPage + 1) + ')">Next</a></li>';
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
            url: "{{ route('karir.blade') }}",
            data: { data: dataJson }, // Kirim data ke Blade
            success: function(response) {
                $('#job-container').html(response); // Tampilkan hasil dari Blade
            },
            error: function(xhr, status, error) {
                console.error('Error displaying data in Blade:', error);
            }
        });
    }

</script>
@endsection
