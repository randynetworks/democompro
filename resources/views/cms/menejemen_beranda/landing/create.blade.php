@extends('cms.layout.index')
@section('judul', 'Landing Page')
@section('sub-judul', 'Manajemen Dashboard')
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
                            <form id="form-add-landing" class="form" action="{{ route('manajemen-landing-page.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="mb-3 col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span>Nama Perusahaan</span>
                                            </label>
                                            <input type="text" class="form-control mb-4" name="nama_perusahaan" id="nama_perusahaan" placeholder="Masukan Nama Perusahaan">
                                        </div>
                                        <div class="mb-3">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">File Gambar</span>
                                            </label>
                                            <input type="file" class="form-control mb-4" name="gambar" id="gambar" onchange="previewImage(event)">
                                        </div>
                                        <img src="" alt="" style="max-height: 300px; width: 100%; display: none;" id="image-preview-img">
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-sm-12">
                                        <div class="mb-3 col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span>Motto</span>
                                            </label>
                                            <input type="text" class="form-control mb-4" name="motto" id="motto"  placeholder="Masukan Motto Perusahaan">
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="mt-3">Motto (Bahasa Inggris)</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control mb-4" name="motto_en" id="motto_en" placeholder="Masukan Motto Perusahaan (Bahasa Inggris)">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="mt-3">Deskripsi</span>
                                            </label>
                                            <textarea id="deskripsi" name="deskripsi" class="mb-2 form-control" placeholder="Masukan Deskripsi"></textarea>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="mt-3">Deskripsi (Bahasa Inggris)</span>
                                            </label>
                                            <textarea id="deskripsi_en" name="deskripsi_en" class="mb-2 form-control" placeholder="Masukan Deskripsi (Bahasa Inggris)"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-4 mb-3">
                                    <a href="{{ route('manajemen-landing-page') }}" class="btn btn-danger me-3">Kembali</a>
                                    <button id="submit_landing" type="submit" class="btn btn-primary">
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
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-add-landing');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'gambar': {
                        validators: {
                            notEmpty: {
                                message: 'Nama Perusahaan harus diisi.'
                            },
                            file: {
                                extension: 'jpeg,jpg,png,gif', // Allowed image file extensions
                                type: 'image/jpeg,image/png,image/gif', // Allowed MIME types
                                maxSize: 2097152, // 2048 * 1024 (2MB)
                                message: 'Hanya bisa upload file gambar (jpeg, jpg, png, gif) dengan ukuran maksimal 2MB.',
                            },
                        }
                    },
                    // 'nama_perusahaan': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Nama Perusahaan harus diisi.'
                    //             },
                    //             stringLength: {
                    //                 min: 3, // Panjang minimum
                    //                 max: 255, // Panjang maksimum
                    //                 message: 'Nama Perusahaan harus antara 3 hingga 255 karakter.'
                    //             }
                    //         }
                    // },
                    // 'motto': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Motto harus diisi.'
                    //             },
                    //             stringLength: {
                    //                 min: 3, // Panjang minimum
                    //                 max: 255, // Panjang maksimum
                    //                 message: 'Motto harus antara 3 hingga 255 karakter.'
                    //             }
                    //         }
                    // }, 
                    // 'motto_en': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Motto (Bahasa Inggris) harus diisi.'
                    //             },
                    //             stringLength: {
                    //                 min: 3, // Panjang minimum
                    //                 max: 255, // Panjang maksimum
                    //                 message: 'Motto (Bahasa Inggris) harus antara 3 hingga 255 karakter.'
                    //             }
                    //         }
                    // },                    
                    // 'deskripsi': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Deskripsi harus diisi.'
                    //             },
                    //         }
                    // },           
                    // 'deskripsi_en': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Deskripsi (Bahasa Inggris) harus diisi.'
                    //             },
                    //         }
                    // },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    bootstrap: new FormValidation.plugins.Bootstrap5()
                }
            }
        );

        // Submit button handler
        const submitButton = document.getElementById('submit_landing');
        submitButton.addEventListener('click', function(e) {
            e.preventDefault();

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
    
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('translateBtn').addEventListener('click', translate);

        function translate() {
            var motto = document.getElementById('motto').value;
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
                            text: motto
                        },
                        success: function(response) {
                            $('#motto_en').val(response.text);
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