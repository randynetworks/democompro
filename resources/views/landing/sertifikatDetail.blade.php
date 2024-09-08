
<div class="modal-body">
    <h2 style="text-align: center;">{{$value->nama}}</h2>
    <div class="col-12 d-flex justify-content-center align-items-center">
        <img src="{{ asset('images/sertifikat') . '/' . $value->gambar }}" class="img-fluid" style="max-height: 300px;">
    </div>
</div>
<div class="modal-footer">
    <!-- <a href="{{ route('sertifikat.download', $value->id) }}" class="btn btn-primary" target="_blank">@lang('home.download')</a> -->
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('home.close')</button>
</div>
