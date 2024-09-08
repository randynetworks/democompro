@foreach ($data as $srt)
    <div class="col-lg-4 col-md-6 mb-4 pb-2">
        {{-- Versi Titik --}}
        {{-- <a href="javascript:;" class="text-black btn-sertifikat" data-id="{{ $srt->id }}">
            <div class="card blog blog-primary border-0 shadow rounded overflow-hidden">
                <div class="position-relative overflow-hidden" style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    <img style="object-fit: contain; width: 100%; min-height: 200px;"
                        src="{{ asset('images/sertifikat') . '/' . $srt->gambar }}" class="img-fluid"  alt=""
                        style="object-fit: contain; height: 200px;"
                        alt="">
                </div>
                <div class="card-body content" style="height: 171.75px;">
                    @php
                        $style_btn = 'bg-biru';
                        if ($srt->kategori == 2){
                            $style_btn = 'bg-hijau';
                        }
                    @endphp
                    <ul class="list-unstyled mb-2">
                        <li class="list-inline-item text-muted small" style=" border-radius:6px;">
                            <span class="badge p-2 {{$style_btn}}">
                                @if ($srt->kategori == 1)
                                    @lang('home.sertifikat')
                                @elseif ($srt->kategori == 2)
                                    @lang('home.prestasi')
                                @endif
                            </span>
                        </li>
                    </ul>
                    <div class="title-heading">
                        <h4>{{$srt->nama ?? '-' }}</h4>
                    </div>
                    <div class="mt-2">
                        <li class="list-inline-item text-muted small me-3"><i
                                class="uil uil-calendar-alt text-dark h6 me-1"></i>
                                {{ \Carbon\Carbon::parse($srt->waktu)->isoFormat('DD MMMM YYYY HH:mm:ss') }}
                        </li>
                    </div>
                </div>
            </div>
        </a> --}}

        {{-- Versi Dian --}}
        <div class="tiny-slide tns-item tns-slide-active" id="tns1-item2">
            <div
                class="card border-0 work-container work-primary work-grid position-relative d-block overflow-hidden my-2 mx-1">
                <div class="card-body p-0"  style="height: 165.48px;">
                    <a target="_blank" href="{{ asset('images/dokumentasi') . '/' . $srt->gambar }}"
                        class="lightbox d-inline-block tobii-zoom" title="">
                        <img src="{{ asset('images/dokumentasi') . '/' . $srt->gambar }}" class="img-fluid shadow rounded"
                            alt="work-image"
                            onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}';">
                        <div class="tobii-zoom__icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <path d="M21 16v5h-5"></path>
                                <path d="M8 21H3v-5"></path>
                                <path d="M16 3h5v5"></path>
                                <path d="M3 8V3h5"></path>
                            </svg></div>
                        <div class="content p-3">
                            <h5 class="mb-0"><a href="javascript:void(0)"
                                    class="text-dark title">{{ $srt->text ?? '-' }}</a></h5>
                            <h6 class="text-muted tag mb-0">
                                {{ \Carbon\Carbon::parse($srt->waktu)->isoFormat('DD MMMM YYYY HH:mm:ss') }}</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    let btnSerfifikat = $('.btn-sertifikat')
    let modalShow = $('#modalShow')

    // event on click
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
                $('.modal-body').html(response)
                modalShow.modal('show')
            },
            fail: function(err) {
                console.log(err)
            }
        });
    })
</script>
