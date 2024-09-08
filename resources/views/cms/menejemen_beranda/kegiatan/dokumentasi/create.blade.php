@extends('cms.layout.index')
@section('judul', 'Dokumentasi')
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
                                <form id="form-create-dokumentasi" class="form" action="{{ route('dokumentasi.store') }}"
                                    autocomplete="off" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <!-- <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span >Kategori</span>
                                                </label>
                                                <select class="form-select mb-2" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Masukan Kategori"
                                                    name="kategori" id="kategori">
                                                    <option></option>
                                                    <option value="1">Sosial</option>
                                                    <option value="2">Acara</option>
                                                </select>
                                            </div> -->
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span>File Gambar</span>
                                                </label>
                                                <input type="file" class="form-control mb-4 mr-4" name="gambar"
                                                    id="gambar" onchange="previewImage(event)">
                                            </div>
                                            <img src="" alt=""
                                                style="max-height: 300px; width: 100%; display: none;"
                                                id="image-preview-img">
                                        </div>
                                        <div class="col-8">
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Waktu</span>
                                                </label>
                                                <input class="form-control mb-4 mr-4 date" name="waktu" id="waktu"
                                                    placeholder="Masukan Waktu">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="mt-3">Teks</span>
                                                </label>
                                                <textarea name="text" id="text" cols="20" rows="3" class="form-control" placeholder="Masukan Teks"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="mt-3">Text (Bahasa Inggris)</span>
                                                </label>
                                                <textarea name="text_en" id="text_en" cols="20" rows="3" class="form-control"
                                                    placeholder="Masukan Text (Bahasa Inggris)"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                </form>
                                <div class="d-flex justify-content-end m-4">
                                    <a href="{{ route('dokumentasi') }}" class="btn btn-danger me-3">Kembali</a>
                                    <button id="submit_create_dokumentasi" type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Simpan</span>
                                    </button>
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
                const form = document.getElementById('form-create-dokumentasi');
                var validator = FormValidation.formValidation(
                    form, {
                        fields: {
                            'gambar': {
                                validators: {
                                    notEmpty: {
                                        message: 'Gambar harus diisi.'
                                    },
                                    file: {
                                        extension: 'jpeg,jpg,png,gif', // Allowed image file extensions
                                        type: 'image/jpeg,image/png,image/gif', // Allowed MIME types
                                        maxSize: 2097152, // 2048 * 1024 (2MB)
                                        message: 'Hanya bisa upload file gambar (jpeg, jpg, png, gif) dengan ukuran maksimal 2MB.',
                                    },
                                }
                            },
                            'waktu': {
                                validators: {
                                    notEmpty: {
                                        message: 'Waktu harus diisi.'
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
                const submitButton = document.getElementById('submit_create_dokumentasi');
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

            // preview gambar
            function previewImage(event) {
                var image = document.getElementById('image-preview-img');
                image.src = URL.createObjectURL(event.target.files[0]);
                image.style.display = 'block';
            }

            //  fungsi translate
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('translateBtn').addEventListener('click', translate);

                function translate() {
                    var text = document.getElementById('text').value;
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
                                    text: text
                                },
                                success: function(response) {
                                    $('#text_en').val(response.text);
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
