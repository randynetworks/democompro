@extends('landing.layouts.index')

@section('content')
    <style>
        /* @media (max-width: 767.98px) {
            .responsive-border {
                border: 1px solid #ccc;
            }

            .tab-content {
                width: 66.67%;
            }

            .tab-content {
                width: 66.67%;
                padding: 0;
                margin: 0 auto;
            }

            .tab-pane .border {
                margin: 0;
                padding: 1rem;
                box-sizing: border-box;
            }

            @media (max-width: 600px) {
                .tab-content {
                    width: 100%;
                    padding: 0;
                }
            }
        } */
    </style>
    <!-- Jumbotron -->
    <section class=" d-table w-100 bg-half-260"
        style="background: url('{{ asset('images/image-header/' . $slider->gambar) }}'); height: 75vh; background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div class="py-5 px-5">
            <div class="position-breadcrumb">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Reindo Syariah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('solusi.heading')</li>
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

    <section class="section">
        <div class="container">
            <div class="d-flex flex-column flex-wrap flex-md-row rounded border p-10 responsive-border">
                <ul class="nav nav-tabs nav-pills border-0 flex-row flex-sm-column flex-md-column mb-3 mb-md-0 fs-6 col-12 text-center"
                    role="tablist" style="display: -webkit-inline-box;">
                    @if ($locale === 'id')
                        @foreach ($content['categories']['id'] as $index => $navTabs)
                            @php
                                $categoryId = str_replace(' ', '-', $navTabs['name']);
                            @endphp
                            <li class="nav-item mt-1 mb-1 me-0 col-4 @if ($navTabs['lang'] == 'id') content-id @else content-en @endif"
                                role="presentation">
                                <a class="nav-link @if ($index === 0) active @endif" data-bs-toggle="tab"
                                    href="#{{ $categoryId }}" aria-selected="false"
                                    role="tab">{{ $navTabs['name'] }}</a>
                            </li>
                        @endforeach
                    @else
                        @foreach ($content['categories']['en'] as $index => $navTabs)
                            @php
                                $categoryId = str_replace(' ', '-', $navTabs['name']);
                            @endphp
                            <li class="nav-item me-0 @if ($navTabs['lang'] == 'id') content-id @else content-en @endif"
                                role="presentation">
                                <a class="nav-link @if ($index === 0) active @endif" data-bs-toggle="tab"
                                    href="#{{ $categoryId }}" aria-selected="false"
                                    role="tab">{{ $navTabs['name'] }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>

                <div class="tab-content col-12" id="myTabContent">
                    @if ($locale === 'id')
                        @foreach ($content['content']['id'] as $index => $navContent)
                            @php
                                $categoryId = str_replace(' ', '-', $navContent['category']);
                            @endphp
                            <div class="tab-pane fade @if ($index === 0) active show @endif"
                                id="{{ $categoryId }}" role="tabpanel">
                                @foreach ($navContent['details'] as $description)
                                    <div class="border p-3">
                                        <h2>{{ $description['judul'] }}</h2>
                                        <h3>{!! $description['deskripsi'] !!}</h3>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        @foreach ($content['content']['en'] as $index => $navContent)
                            @php
                                $categoryId = str_replace(' ', '-', $navContent['category']);
                            @endphp
                            <div class="tab-pane fade @if ($index === 0) active show @endif"
                                id="{{ $categoryId }}" role="tabpanel">
                                @foreach ($navContent['details'] as $description)
                                    <div class="border p-3">
                                        <h2>{{ $description['judul'] }}</h2>
                                        <h3>{!! $description['deskripsi'] !!}</h3>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div><!--end container-->
    </section><!--end section-->
    <!-- End -->
@endsection

@push('modal')
@endpush

@section('scripts')
    {{-- <script>
        var checkBox = document.getElementById('flexSwitchCheckDefault');
        var contentIdElements = document.querySelectorAll('.content-id');
        var contentEnElements = document.querySelectorAll('.content-en');
        var currentContent = document.querySelector('#myTabContent .active.show');
        var currentNav = document.querySelector('.nav-link.active');
        if (checkBox.checked) {
            let parentLi = currentNav.parentElement;
            let nextLi = parentLi.nextElementSibling;
            let nextNav = nextLi.querySelector('.nav-link');
            currentNav.classList.remove('active');
            nextNav.classList.add('active');
            currentNav = nextNav;
            let nextElement = currentContent.nextElementSibling;
            nextElement.classList.add('active', 'show');
            currentContent.classList.remove('active','show');
            currentContent = nextElement;
            // Show English content
            contentIdElements.forEach(function(element) {
                element.style.display = 'none';
            });
            contentEnElements.forEach(function(element) {
                element.style.display = 'block';
            });
        } else {
            // Show original content
            contentIdElements.forEach(function(element) {
                element.style.display = 'block';
            });
            contentEnElements.forEach(function(element) {
                element.style.display = 'none';
            });
        }
</script> --}}
@endsection
