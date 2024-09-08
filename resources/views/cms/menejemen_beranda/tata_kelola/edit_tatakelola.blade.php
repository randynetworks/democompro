<form id="form-edit-tatakelola" class="form" action="{{ route('file-tata-kelola.update_tatakelola', $data->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required mt-3">File</span>
                </label>
                <input type="file" class="form-control mb-4 mr-4 file" name="tata_kelola" id="tata_kelola" >
                @if($data->tata_kelola != NULL)
                <a href="{{ asset('images/tatakelola/' . $data->tata_kelola) }}" target="_blank">Lihat File</a>
                @endif
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end m-4">
        <button id="submit_tata_kelola" type="submit" class="btn btn-primary">
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
        const form = document.getElementById('form-edit-tatakelola');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'tata_kelola': {
                        validators: {
                            file: {
                                extension: 'pdf',
                                type: 'application/pdf',
                                maxSize: 5242880, // 5 * 1024 * 1024
                                message: 'Hanya bisa upload file PDF dengan ukuran max 5MB',
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
        const submitButton = document.getElementById('submit_tata_kelola');
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
