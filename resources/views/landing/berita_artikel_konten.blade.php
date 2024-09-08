@foreach ($data as $brt)
    {{-- Versi Dian --}}
    <div class="col-lg-4 col-md-6 mt-4 pt-2">
        <!-- <div class="card blog blog-primary rounded border-0 shadow h-100">
            <div class="position-relative">
                <img style="object-fit: cover;"  src="{{ asset('images/berita_artikel') . '/' . $brt->thumbnail }}" class="img-fluid rounded-top"
                alt="thumbnail">
                <div class="overlay rounded-top"></div>
            </div>
            <div class="card-body content flex-grow-1">
                <h5><a href="javascript:void(0)" class="card-title title text-dark">{{ $brt->judul }}</a></h5>
                <div class="post-meta d-flex justify-content-between mt-3">
                    <ul class="list-unstyled mb-0">
                        <p class="mb-0"><i class="uil uil-eye text-muted me-1"></i>{{$brt->total_kunjung}}</p>
                    </ul>
                    <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                        href="{{ route('berita.artikel.defail', encrypt($brt->id)) }}" onclick="kunjung('{{ $brt->id }}');">
                            @lang('home.berita_artikel.button_lihat') >
                        </a>
                </div>
            </div>
            <div class="author">
                <small class="date"><i class="uil uil-calendar-alt"></i> {{ \Carbon\Carbon::parse($brt->waktu)->isoFormat('DD MMMM YYYY HH:mm:ss') }}</small>
            </div>
        </div> -->
        <div class="card blog blog-primary rounded border-0 shadow h-100 d-flex flex-column">
            <div class="position-relative">
                <img style="object-fit: cover; height: 300px;" src="{{ asset('images/berita_artikel') . '/' . $brt->thumbnail }}" class="img-fluid rounded-top" alt="thumbnail"
                    onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                <div class="overlay rounded-top"></div>
            </div>
            <div class="card-body content d-flex flex-column flex-grow-1">
                <h5><a href="javascript:void(0)" class="card-title title text-dark">{{ $brt->judul }}</a></h5>
                <div class="post-meta d-flex justify-content-between mt-3 mt-auto">
                    <ul class="list-unstyled mb-0">
                        <p class="mb-0"><i class="uil uil-eye text-muted me-1"></i>{{$brt->total_kunjung}}</p>
                    </ul>
                    <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{ route('berita.artikel.defail', $brt->slug) }}" onclick="kunjung('{{ $brt->id }}');">
                        @lang('home.berita_artikel.button_lihat') >
                    </a>
                </div>
            </div>
            <div class="author mt-3">
                <small class="date"><i class="uil uil-calendar-alt"></i> {{ \Carbon\Carbon::parse($brt->waktu)->isoFormat('DD MMMM YYYY HH:mm:ss') }}</small>
            </div>
        </div>

    </div>
@endforeach

<script>
    function kunjung(id) {
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            url: "{{ route('berita.kunjung', '') }}" + '/' + id,
            success: function(response) {
                console.error(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>
