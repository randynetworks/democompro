@extends('cms.layout.index')
@section('judul', 'Manajemen Daftar Lowongan')
@section('content')
<style>
    .cke_notifications_area { display: none; }
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<div id="kt_content_container" class="container-xxl">
			<div class="row gy-5 g-xl-10">
				<div class="col-xl-12 mb-5 mb-xl-10">
					<div class="card card-flush h-xl-100">
						<div class="card-header pb-0 pt-10 d-flex justify-content-between align-items-center">
                            <div class="ms-auto ">
                                <button class="btn btn-sm btn-primary" id="translateBtn" ><i class="bi bi-translate"></i> Translate</button>
                            </div>
                            <div id="translateBtn_tooltips" >
                                <i class="fas fa-exclamation-circle ms-2 fs-7 mt-1" data-bs-toggle="tooltip" title="Tombol ini untuk memanggil fungsi Translate ke Bahasa Inggris secara otomatis." ></i>
                            </div>
						</div>
						<div class="card-body pb-0 pt-10">
                            <form id="form-edit-job" class="form" action="{{ route('manajemen-daftar-lowongan.update', $data->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-5">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Judul Lowongan</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="judul" id="judul" placeholder="Masukan Judul Lowongan" value="{{$data->judul}}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Judul Lowongan (Bahasa Inggris)</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="judul_en" id="judul_en" placeholder="Masukan Judul Lowongan (Bahasa Inggris)" value="{{$data->judul_en}}">
                                        </div>                     
                                    </div>
                                    <div class="col-7">
                                        <div class="col-md-12">                        
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">File Gambar</span>
                                            </label>
                                            <input type="file" class="form-control mb-4 mr-4" name="gambar" id="gambar" onchange="previewImage(event)">
                                        </div>
                                        <img src="{{ asset('/images/joblist/' . $data->gambar) }}" alt="" height="300px" width="300px"  id="image-preview-img" onerror="this.style.display='none'">
                                    </div>
                                    <div class="col-12">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Deskripsi</span>
                                            </label>
                                            <textarea id="deskripsi" name="deskripsi" class="mb-2 form-control" style="height: 150px;" placeholder="Masukan Deskripsi">{{$data->deskripsi}}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Deskripsi (Bahasa Inggris)</span>
                                            </label>
                                            <textarea id="deskripsi_en" name="deskripsi_en" class="mb-2 form-control" style="height: 150px;" placeholder="Masukan Deskripsi (Bahasa Inggris)">{{$data->deskripsi_en}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end m-4">
                                    <a href="{{ route('manajemen-daftar-lowongan') }}" class="btn btn-danger me-3">Kembali</a>
                                    <button id="submit_job" type="submit" class="btn btn-primary">
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
        // inisiasi ckeditor
        CKEDITOR.replace('deskripsi');
        CKEDITOR.replace('deskripsi_en');
        
        validasi();

        // flatpicker
        $(".date").flatpickr({
            enableTime: !0,
            dateFormat: "Y-m-d H:i",
        });
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-edit-job');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'gambar': {
                        validators: {
                            file: {
                                extension: 'jpeg,jpg,png,gif', // Allowed image file extensions
                                type: 'image/jpeg,image/png,image/gif', // Allowed MIME types
                                maxSize: 2097152, // 2048 * 1024 (2MB)
                                message: 'Hanya bisa upload file gambar (jpeg, jpg, png, gif) dengan ukuran maksimal 2MB.',
                            },
                        }
                    },
                    'judul': {
                        validators: {
                            notEmpty: {
                                message: 'Judul harus diisi.'
                            },
                            stringLength: {
                                min: 3, // Panjang minimum
                                max: 255, // Panjang maksimum
                                message: 'Judul harus antara 3 hingga 255 karakter.'
                            }
                        }
                    },
                    'judul_en': {
                        validators: {
                            notEmpty: {
                                message: 'Judul (Bahasa Inggris) harus diisi.'
                            },
                            stringLength: {
                                min: 3, // Panjang minimum
                                max: 255, // Panjang maksimum
                                message: 'Judul (Bahasa Inggris) harus antara 3 hingga 255 karakter.'
                            }
                        }
                    },
                    'deskripsi': {
                        validators: {
                            notEmpty: {
                                message: 'Deskripsi harus diisi.'
                            },
                        }
                    },                  
                    'deskripsi_en': {
                        validators: {
                            notEmpty: {
                                message: 'Deskripsi (Bahasa Inggris) harus diisi.'
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
        const submitButton = document.getElementById('submit_job');
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

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

    
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('translateBtn').addEventListener('click', translate);

        function translate() {
            // get value
            var judul = document.getElementById('judul').value;
            // get value dengan ckeditor
            var deskripsi_en = CKEDITOR.instances.deskripsi;
            var deskripsi = deskripsi_en.getData();

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
                            text: judul
                        },
                        success: function(response) {
                            // replace value
                            $('#judul_en').val(response.text);
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
                            // replace valure dengan ckeditor
                            CKEDITOR.instances.deskripsi_en.setData(response.text);

                            translateBtn.textContent = 'Translate';
                            translateBtn.style.pointerEvents = 'auto';
                        },
                        error: function(xhr) {
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