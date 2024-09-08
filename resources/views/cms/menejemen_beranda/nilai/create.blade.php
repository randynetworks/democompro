@extends('cms.layout.index')
@section('judul', 'Nilai')
@section('sub-judul', 'Manajemen Beranda')
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
                            <form id="form-add-nilai" class="form" action="{{ route('manajemen-nilai.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Teks</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="text" id="text" placeholder="Masukan Teks">
                                        </div>                                 
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Text (Bahasa Inggris)</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="text_en" id="text_en" placeholder="Masukan Text (Bahasa Inggris)">
                                        </div>                                                                        
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span>Deskripsi</span>
                                            </label>
                                            <textarea class="form-control mb-4 mr-4" name="deskripsi" id="deskripsi" placeholder="Masukan Deskripsi"></textarea>
                                        </div>                                                                         
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span>Deskripsi (Bahasa Inggris)</span>
                                            </label>
                                            <textarea class="form-control mb-4 mr-4" name="deskripsi_en" id="deskripsi_en" placeholder="Masukan Deskripsi (Bahasa Inggris)"></textarea>
                                        </div>                                                                
                                        <!-- <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Icon</span>
                                            </label>
                                            <p class="m-2">Icon diambil dari <a href="https://icons.getbootstrap.com/" target="_blank">sini.</a></p>
                                            <textarea name="icon" id="icon" cols="20" rows="5" class="form-control" placeholder="Masukan SVG"></textarea>
                                            <p class="m-2"><b>Petunjuk : Copy Kode HTML SVG dan Paste disini.</b></p>
                                        </div> -->
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">File Gambar</span>
                                            </label>
                                            <input type="file" class="form-control mb-4 mr-4" name="gambar"
                                                id="gambar" onchange="previewImage(event)">
                                        </div>
                                        <img src="" alt=""
                                            style="max-height: 100px; display: none;"
                                            id="image-preview-img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end m-4">
                                    <a href="{{ route('manajemen-nilai') }}" class="btn btn-danger me-3">Kembali</a>
                                    <button id="submit_nilai" type="submit" class="btn btn-primary">
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
        const form = document.getElementById('form-add-nilai');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    // 'icon': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Icon harus diisi.'
                    //         },
                    //         callback: {
                    //             message: 'Harap masukkan tag SVG yang valid.',
                    //             callback: function(input) {
                    //                 // Memeriksa apakah input dimulai dengan <svg dan diakhiri dengan </svg>
                    //                 if (input.value.startsWith('<svg') && input.value.endsWith('</svg>')) {
                    //                     return true;
                    //                 } else {
                    //                     return false;
                    //                 }
                    //             }
                    //         }
                    //     }
                    // },
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
                    'text': {
                            validators: {
                                notEmpty: {
                                    message: 'Teks harus diisi.'
                                },
                                stringLength: {
                                    min: 3, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Teks harus antara 3 hingga 255 karakter.'
                                }
                            }
                    },
                    'text_en': {
                            validators: {
                                notEmpty: {
                                    message: 'Text (Bahasa Inggris) harus diisi.'
                                },
                                stringLength: {
                                    min: 3, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Text (Bahasa Inggris) harus antara 3 hingga 255 karakter.'
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
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    bootstrap: new FormValidation.plugins.Bootstrap5()
                }
            }
        );

        // Submit button handler
        const submitButton = document.getElementById('submit_nilai');
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
            var text = document.getElementById('text').value;
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
                            text: text
                        },
                        success: function(response) {
                            $('#text_en').val(response.text);
                            translateBtn.textContent = 'Translate';
                            translateBtn.style.pointerEvents = 'auto';
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
                        }
                    });
                }
            });
        }
    });

    function previewImage(event) {
        var image = document.getElementById('image-preview-img');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.display = 'block';
    }
</script>
@endsection