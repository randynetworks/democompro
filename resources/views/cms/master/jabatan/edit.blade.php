@extends('cms.layout.index')
@section('judul', 'Master Jabatan')
@section('sub-judul', 'Master')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<div id="kt_content_container" class="container-xxl">
			<div class="row gy-5 g-xl-10">
				<div class="col-xl-12 mb-5 mb-xl-10">
					<div class="card card-flush h-xl-100">
                        <div class="card-header pb-0 pt-10 d-flex justify-content-between align-items-center">
                            <div class="ms-auto ">
                                <button class="btn btn-sm btn-primary" id="translateBtn"><i class="bi bi-translate"></i> Translate</button>
                            </div>
                            <div class="">
                                <i class="fas fa-exclamation-circle ms-2 fs-7 mt-1" data-bs-toggle="tooltip" title="Tombol ini untuk memanggil fungsi Translate ke Bahasa Inggris secara otomatis."></i>
                            </div>
                        </div>
						<div class="card-body pb-0 pt-10">
                            <form id="form-edit-jabatan" class="form" action="{{ route('master-jabatan.update', $data->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Jabatan</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="jabatan" id="jabatan" placeholder="Masukan Jabatan" value="{{$data->jabatan}}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Jabatan (Bahasa Inggris)</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="jabatan_en" id="jabatan_en" placeholder="Masukan Jabatan (Bahasa Inggris)" value="{{$data->jabatan_en}}">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Level</span>
                                            </label>
                                            <input type="number" class="form-control mb-4 mr-4" name="level" id="level" placeholder="Masukan Level" value="{{$data->level}}" min="1" max="99" oninput="validity.valid||(value='');" onkeydown="if(event.key==='e'||event.key==='E')event.preventDefault();">
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <div class="d-flex justify-content-end m-4">
                                <a href="{{ route('master-jabatan') }}" class="btn btn-danger me-3">Kembali</a>
                                <button id="submit_jabatan" type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Simpan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var id = "{{ $data->id }}";
</script>

@endsection

@section('js')
<script>
    $(function() {
        validasi();
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-edit-jabatan');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'jabatan': {
                            validators: {
                                notEmpty: {
                                    message: 'Jabatan harus diisi.'
                                },
                                stringLength: {
                                    min: 2, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Jabatan harus antara 2 hingga 255 karakter.'
                                },
                                remote: { // cek nama jabatan yang sudah ada didatabase
                                    url: "{{ route('master-jabatan.cekJabatan') }}",
                                    data: function () {
                                        return {
                                            jabatan: form.querySelector('[name="jabatan"]').value,
                                            id: id,
                                        };
                                    },
                                    message: 'Nama Jabatan sudah ada.',
                                    type: 'GET',
                                    delay: 1000
                                }
                            }
                    },
                    'jabatan_en': {
                            validators: {
                                notEmpty: {
                                    message: 'Jabatan (Bahasa Inggris) harus diisi.'
                                },
                                stringLength: {
                                    min: 2, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Jabatan harus antara 2 hingga 255 karakter.'
                                },
                                remote: { // cek nama jabatan en yang sudah ada di datasbase
                                    url: "{{ route('master-jabatan.cekJabatanEn') }}",
                                    data: function () {
                                        return {
                                            email: form.querySelector('[name="jabatan_en"]').value,
                                            id: id,
                                        };
                                    },
                                    message: 'Nama Jabatan (Bahasa Inggris) sudah ada.',
                                    type: 'GET',
                                    delay: 1000
                                }
                            }
                    },
                    'level': {
                            validators: {
                                notEmpty: {
                                    message: 'Level harus diisi.'
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
        const submitButton = document.getElementById('submit_jabatan');
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function(status) {

                    if (status == 'Valid') {
                        form.submit(); // Submit form
                    }
                });
            }
        });
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('translateBtn').addEventListener('click', translate);

        function translate() {
            var jabatan = document.getElementById('jabatan').value;
            var translateBtn = document.getElementById('translateBtn');

            Swal.fire({
                title: 'Generate Translate',
                text: 'Apakah anda yakin?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Translate',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    translateBtn.textContent = 'Loading...';
                    translateBtn.style.pointerEvents = 'none';

                    $.ajax({
                        url: "{{ route('translate') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            text: jabatan
                        },
                        success: function(response) {
                            $('#jabatan_en').val(response.text);
                            translateBtn.textContent = 'Translate';
                            translateBtn.style.pointerEvents = 'auto';
                        },
                        error: function(xhr) {
                            // console.log("xhr.responseText");
                            translateBtn.textContent = 'Translate';
                            translateBtn.style.pointerEvents = 'auto';
                        }
                    });

                }
            });
        }
    });
</script>
@endsection
