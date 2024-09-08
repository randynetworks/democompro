<div class="d-flex justify-content-end mb-4">
    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
        <i class="uil uil-times fs-4 text-dark"></i>
    </button>
</div>

@if ($tipe == 'bulan')
    @foreach ($bulan as $bln => $value)
        <div class="row my-1">
            <div class="col-8">
                Laporan Bulanan - {{ (new DateTime($value->bulan . '-01'))->format('F Y') }}
            </div>
            <div class="col-4 text-end">
                <!-- <a class="btn btn-sm btn-secondary" target="_blank"
                    href="{{ route('landing.download.keuangan', ['id' => $value->id, 'tipe' => $tipe]) }}">@lang('home.download')</a> -->
                    <a class="btn btn-lg" target="_blank" 
                        href="{{ route('landing.download.keuangan', ['id' => $value->id, 'tipe' => $tipe]) }}" 
                        style="display: inline-flex; align-items: center; text-decoration: none; background: #194E83; color: white; padding: 8px 12px; border-radius: 4px;">
                        <i class="bi bi-download"></i>
                    </a>
            </div>
        </div>
        <hr>
    @endforeach
@else
    @foreach ($tahun as $thn => $value)
        <div class="row my-1">
            <div class="col-6">
                Laporan Tahunan - {{ $value->tahun }}
            </div>

            <div class="col-6 text-end">
                <!-- <a class="btn btn-sm btn-secondary" target="_blank"
                    href="{{ route('landing.download.keuangan', ['id' => $value->id, 'tipe' => $tipe]) }}">@lang('home.download')</a> -->
                <a class="btn btn-lg" target="_blank" 
                    href="{{ route('landing.download.keuangan', ['id' => $value->id, 'tipe' => $tipe]) }}" 
                    style="display: inline-flex; align-items: center; text-decoration: none; background: #194E83; color: white; padding: 8px 12px; border-radius: 4px;">
                    <i class="bi bi-download"></i>
                </a>
            </div>
        </div>
        <hr>
    @endforeach
@endif
