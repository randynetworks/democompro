<form id="form-edit-images" class="form" action="{{ route('manajemen-image-header.update', $data->id) }}" autocomplete="off"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <input type="hidden" name="id" id="id" value="{{$data->id}}">
            <h4>Halaman : {{$data->kategori}}</h4>
            <div class="col-md-12">
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required mt-3">File</span>
                </label>
                <input type="file" class="form-control mb-4 mr-4 file" name="gambar" id="gambar" >
                @if($data->gambar != NULL)
                <a href="{{ asset('images/image-header/' . $data->gambar) }}" target="_blank">Lihat File</a>
                @endif
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end m-4">
        <button id="submit_images" type="submit" class="btn btn-primary">
            <span class="indicator-label">Simpan</span>
        </button>
    </div>
</form>

<script>
    $(function() {
        validasi();
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-edit-images');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'gambar': {
                        validators: {
                            notEmpty: {
                                message: 'File harus diisi.'
                            },
                                file: {
                                    extension: 'jpeg,jpg,png,gif', // Allowed image file extensions
                                    type: 'image/jpeg,image/png,image/gif', // Allowed MIME types
                                    maxSize: 2097152, // 2048 * 1024 (2MB)
                                    message: 'Hanya bisa upload file gambar (jpeg, jpg, png, gif) dengan ukuran maksimal 2MB.',
                                },
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    bootstrap: new FormValidation.plugins.Bootstrap5()
                }
            }
        );

        // Submit button handler
        const submitButton = document.getElementById('submit_images');
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function(status) {

                    if (status == 'Valid') {
                        // block_ui();
                        form.submit(); // Submit form
                    }
                });
            }
        });
    }
</script>
