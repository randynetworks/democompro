<form id="form-edit-laporan" class="form" action="{{ route('laporan-keuangan-tahunan.update', $data->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <input type="hidden" name="id" id="id" value="{{$data->id}}">
            <div class="col-md-12">
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required">Tahun</span>
                </label>
                <!-- <input type="month" class="form-control mb-4 mr-4 date" name="tahun" id="tahun" placeholder="Masukan Tahun">  -->
                <select class="form-control mb-4 mr-4" name="tahun" id="tahun" data-control="select2" data-hide-search="true" data-placeholder="Masukan Tahun">
                    <option></option>
                    <?php foreach($years as $year) : ?>
                        <option value="<?php echo $year; ?>" <?php echo $year == $data->tahun ? 'selected' : ''; ?>><?php echo $year; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- <div class="col-md-12">
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required mt-3">Rata-rata</span>
                </label>
                <input type="number" step="0.01" class="form-control mb-4 mr-4" name="rata_rata" id="rata_rata" placeholder="Masukan Rata-rata" onKeyPress="if(this.value.length==13) return false;" onkeydown="return event.keyCode !== 69" value="{{$data->rata_rata}}">
            </div> -->
            <div class="col-md-12">
                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                    <span class="required mt-3">File</span>
                </label>
                <input type="file" class="form-control mb-4 mr-4 file" name="file" id="file" >
                @if($data->file != NULL)
                <a href="{{ asset('images/laporan-tahunan/' . $data->file) }}" target="_blank">Lihat File</a>
                @endif
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end m-4">
        <button id="submit_laporan" type="submit" class="btn btn-primary">
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
        const form = document.getElementById('form-edit-laporan');
        var validator = FormValidation.formValidation(
            form, {
                fields: {                                         
                    'tahun': {
                            validators: {
                                notEmpty: {
                                    message: 'Tahun harus diisi.'
                                },
                                remote: {
                                    url: "{{ route('laporan-keuangan-tahunan.cekBulan') }}",
                                    data: function () {
                                        return {
                                            id: form.querySelector('[name="id"]').value,
                                            tahun: form.querySelector('[name="tahun"]').value,
                                        };
                                    },
                                    message: 'Laporan pada Tahun tersebut sudah ada.',
                                    type: 'GET',
                                    delay: 1000
                                }
                            }
                    },  
                    // 'rata_rata': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Rata-rata harus diisi.'
                    //             },
                    //         }
                    // },
                    'file': {
                        validators: {
                            file: {
                                extension: 'pdf',
                                type: 'application/pdf',                             
                                maxSize: 5242880, // 5 * 1024 * 1024
                                //maxSize: 2097152, // 2048 * 1024 (2MB)
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
        const submitButton = document.getElementById('submit_laporan');
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