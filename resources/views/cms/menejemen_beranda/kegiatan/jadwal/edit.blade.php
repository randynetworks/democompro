@extends('cms.layout.index')
@section('judul', 'Jadwal Acara')
@section('sub-judul', 'Manajemen Beranda - Kegiatan')
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
                                <form id="form-edit-jadwal" class="form" action="{{ route('jadwal.update', $data->id) }}"
                                    autocomplete="off" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col-md-12 mb-4">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required mt-3">Headline</span>
                                                </label>
                                                <textarea id="headline" name="headline" class="mb-2 form-control" placeholder="Masukan Headline Acara" cols="30"
                                                    rows="2">{{ $data->headline }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required mt-3">Headline (Bahasa Inggris)</span>
                                                </label>
                                                <textarea id="headline_en" name="headline_en" class="mb-2 form-control"
                                                    placeholder="Masukan Headline Acara (Bahasa Inggris)" cols="30" rows="2">{{ $data->headline_en }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="mt-3">Deskripsi Acara</span>
                                                </label>
                                                <textarea id="deskripsi" name="deskripsi" class="mb-2 form-control" placeholder="Masukan Deskripsi Acara" cols="30"
                                                    rows="3">{{ $data->deskripsi }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="mt-3">Deskripsi Acara (Bahasa Inggris)</span>
                                                </label>
                                                <textarea id="deskripsi_en" name="deskripsi_en" class="mb-2 form-control"
                                                    placeholder="Masukan Deskripsi Acara (Bahasa Inggris)" cols="30" rows="3">{{ $data->deskripsi_en }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Waktu Mulai</span>
                                                </label>
                                                <input class="form-control mb-4 mr-4 date" name="start_date" id="start_date"
                                                    value="{{ $data->start_date }}" placeholder="Masukan Waktu Mulai">
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Waktu Selesai</span>
                                                </label>
                                                <input class="form-control mb-4 mr-4 date" name="end_date" id="end_date"
                                                    value="{{ $data->end_date }}" placeholder="Masukan Waktu Selesai">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end m-4">
                                        <a href="{{ route('jadwal') }}" class="btn btn-danger me-3">Kembali</a>
                                        <button id="submit_jadwal" type="submit" class="btn btn-primary">
                                            <span class="indicator-label">Simpan</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            validasi();

            // flatpicker
            $(".date").flatpickr({
                enableTime: !0,
                dateFormat: "Y-m-d H:i",
            });
        });

        // validasi inputan kosong
        function validasi() {
            const form = document.getElementById('form-edit-jadwal');
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'headline': {
                            validators: {
                                notEmpty: {
                                    message: 'Headline harus diisi.'
                                },
                                stringLength: {
                                    min: 3, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Headline harus antara 3 hingga 255 karakter.'
                                }
                            }
                        },
                        'headline_en': {
                            validators: {
                                notEmpty: {
                                    message: 'Headline (Bahasa Inggris) harus diisi.'
                                },
                                stringLength: {
                                    min: 3, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Headline (Bahasa Inggris) harus antara 3 hingga 255 karakter.'
                                }
                            }
                        },
                        // 'deskripsi': {
                        //     validators: {
                        //         notEmpty: {
                        //             message: 'Deskripsi harus diisi.'
                        //         },
                        //     }
                        // },
                        // 'deskripsi_en': {
                        //     validators: {
                        //         notEmpty: {
                        //             message: 'Deskripsi (Bahasa Inggris) harus diisi.'
                        //         },
                        //     }
                        // },
                        'start_date': {
                            validators: {
                                notEmpty: {
                                    message: 'Waktu Mulai harus diisi.'
                                },
                            }
                        },
                        'end_date': {
                            validators: {
                                notEmpty: {
                                    message: 'Waktu Selesai harus diisi.'
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
            const submitButton = document.getElementById('submit_jadwal');
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

        
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('translateBtn').addEventListener('click', translate);

            function translate() {
                var headline = document.getElementById('headline').value;
                var deskripsi = document.getElementById('deskripsi').value;
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
                                text: headline
                            },
                            success: function(response) {
                                $('#headline_en').val(response.text);
                            },
                            error: function(xhr) {
                                // console.log("xhr.responseText");
                            }
                        });

                        $.ajax({
                            url: "{{ route('translate') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                text: deskripsi
                            },
                            success: function(response) {
                                $('#deskripsi_en').val(response.text);
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
