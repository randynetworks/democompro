<div class="modal-body">
    <div class="col-12 d-flex justify-content-center align-items-center">
        <img src="{{ asset('images/dokumentasi') . '/' . $value->gambar }}" class="img-fluid" style="max-height: 300px;">
    </div>
</div>
<div class="modal-footer">
    <!-- <a href="{{ route('dokumentasi.download', $value->id) }}" class="btn btn-primary" target="_blank">@lang('home.download')</a> -->
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
    @lang('home.close')
    </button>
</div