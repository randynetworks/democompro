{{--versi 1 --}}
<!-- <div class="d-flex justify-content-end mb-4">
    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
        <i class="uil uil-times fs-4 text-dark"></i>
    </button>
</div>
<img src="{{ asset('images/jajaran-kami/' . $item?->gambar) }}" alt="Profile Image"
    class="img-fluid avatar avatar-medium rounded-circle  mb-4">
<h4 class="mb-2">{{ $item->nama }}</h4>
<h5 class="mb-2">
    @if (App::getLocale() == 'id')
        <h5 class="">{{ $item->tagline ?? '' }}</h5>
    @elseif(App::getLocale() == 'en')
        <h5 class="">{{ $item->tagline_en ?? '' }}</h5>
    @endif
</h5>
<p class="">{!! $item->deskripsi !!}</p> -->

{{-- versi 2 --}}
<!-- <div class="container-fluid px-0">
    <div class="row align-items-center">
        <div class="col-5 m-1">
            <div class="col-md-12">
                <img src="{{ asset('images/jajaran-kami/' . $item?->gambar) }}" class="img-fluid" alt="">
                <h4 class="mt-2 mb-2 text-center">{{ $item->nama }}</h4>
                @if (App::getLocale() == 'id')
                    <h5 class="mb-2 text-center">{{ $item->tagline ?? '' }}</h5>
                @elseif(App::getLocale() == 'en')
                    <h5 class="mb-2 text-center">{{ $item->tagline_en ?? '' }}</h5>
                @endif
            </div>
        </div>
        <div class="col-6 m-1">
            <div class="col-md-12">
            <p class="">{!! $item->deskripsi !!}</p>
            </div>
        </div>
    </div>
</div> -->

{{-- versi 3 --}}
<!-- <div class="d-flex justify-content-end mb-0">
    
</div> -->
<!-- <div class="row g-0 align-items-center">
    <div class="col-lg-6">
        <img src="{{ asset('images/jajaran-kami/' . $item?->gambar) }}" class="img-fluid" alt="">
    </div>
    <div class="col-lg-6">
        <div class="card-body section-title p-md-5">
            <h4 class="mt-2 mb-2 ">{{ $item->nama }}</h4>
            @if (App::getLocale() == 'id')
                <h5 class="mb-2 ">{{ $item->tagline ?? '' }}</h5>
            @elseif(App::getLocale() == 'en')
                <h5 class="mb-2 ">{{ $item->tagline_en ?? '' }}</h5>
            @endif
            <p class="">{!! $item->deskripsi !!}</p>
        </div>
    </div>
</div> -->
<style>
    .text-container {
    max-height: 400px; /* Adjust the height as needed */
    overflow-y: auto;
}
</style>
<div class="row g-0 align-items-center">
    <div class="col-lg-6">
        <img src="{{ asset('images/jajaran-kami/' . $item?->gambar) }}" class="img-fluid" alt="">
    </div>
    <div class="col-lg-6">
        <!-- <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button> -->
         <button type="button" class="btn btn-icon btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" id="close-modal">
            <i class="uil uil-times fs-4 text-dark"></i>
        </button>
        <div class="card-body section-title p-md-5 text-container">
            <h4 class="mt-2 mb-2 ">{{ $item->nama }}</h4>
            @if (App::getLocale() == 'id')
                <h5 class="mb-2 ">{{ $item->tagline ?? '' }}</h5>
            @elseif(App::getLocale() == 'en')
                <h5 class="mb-2 ">{{ $item->tagline_en ?? '' }}</h5>
            @endif
            <p class="">{!! $item->deskripsi !!}</p>
        </div>
    </div>
</div>
