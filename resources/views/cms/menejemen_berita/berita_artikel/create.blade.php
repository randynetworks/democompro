@extends('cms.layout.index')
@section('judul', 'Berita & Artikel')
@section('sub-judul', 'Manajemen Berita')
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
                            <form id="form-add-berita" class="form" action="{{ route('berita-artikel.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Judul Berita</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="judul" id="judul" placeholder="Masukan Judul Berita">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Judul Berita (Bahasa Inggris)</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="judul_en" id="judul_en" placeholder="Masukan Judul Berita (Bahasa Inggris)">
                                        </div>                                            
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Kategori</span>
                                            </label>
                                            <select class="form-select mb-2" data-control="select2"
                                                data-hide-search="true" data-placeholder="Masukan Kategori"
                                                name="kategori" id="kategori">
                                                <option></option>
                                                <option value="1">Berita</option>
                                                <option value="2">Artikel</option>
                                            </select>
                                        </div>                                    
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Waktu</span>
                                            </label>
                                            <input class="form-control mb-4 mr-4 date" name="waktu" id="waktu"
                                                placeholder="Masukan Waktu">
                                        </div>
                                        <div class="col-md-12">                        
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">File Gambar</span>
                                            </label>
                                            <input type="file" class="form-control mb-4 mr-4" name="thumbnail" id="thumbnail" onchange="previewImage(event)">
                                        </div>
                                        <img src="" alt="" style="max-height: 300px; width: 100%; display: none;"  id="image-preview-img" >
                                    </div>
                                    <div class="col-8">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Isi Berita</span>
                                            </label>
                                            <textarea id="isi_berita" name="isi_berita" class="mb-2 form-control" style="height: 150px;" placeholder="Masukan Isi Berita"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Isi Berita (Bahasa Inggris)</span>
                                            </label>
                                            <textarea id="isi_berita_en" name="isi_berita_en" class="mb-2 form-control" style="height: 150px;" placeholder="Masukan Isi Berita (Bahasa Inggris)"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end m-4">
                                    <a href="{{ route('berita-artikel') }}" class="btn btn-danger me-3">Kembali</a>
                                    <button id="submit_berita" type="submit" class="btn btn-primary">
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
        CKEDITOR.replace('isi_berita');
        CKEDITOR.replace('isi_berita_en');
        
        validasi();

        // flatpicker
        $(".date").flatpickr({
            enableTime: !0,
            dateFormat: "Y-m-d H:i",
        });
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-add-berita');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'thumbnail': {
                        validators: {
                            notEmpty: {
                                message: 'Thumbnail harus diisi.'
                            },
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
                    'isi_berita': {
                        validators: {
                            notEmpty: {
                                message: 'Isi Berita harus diisi.'
                            },
                        }
                    },                  
                    'isi_berita_en': {
                        validators: {
                            notEmpty: {
                                message: 'Isi Berita (Bahasa Inggris) harus diisi.'
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
                    'kategori': {                        
                        validators: {
                            notEmpty: {
                                message: 'Kategori harus diisi.'
                            },
                        },
                        callback:{
                            callback:(input) => {
                                const elemenSelect = document.querySelector('#form-add-berita > div.row.fv-plugins-icon-container > div.col-4 > div:nth-child(3) > span');
                                                                                                
                                if(input.value == ''){
                                    elemenSelect.classList.remove('is-valid');
                                    elemenSelect.classList.add('is-invalid');
                                    return{
                                        valid: false,
                                        message: 'Kategori harus dipilih.'
                                    }
                                }else{
                                    elemenSelect.classList.remove('is-invalid');
                                    elemenSelect.classList.add('is-valid');
                                    return{
                                        valid: true,
                                    }
                                }
                            }
                        },
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
        const submitButton = document.getElementById('submit_berita');
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
            var judul = document.getElementById('judul').value;
            var isi_berita_en = CKEDITOR.instances.isi_berita;
            var isi_berita = isi_berita_en.getData();

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
                            text: isi_berita
                        },
                        success: function(response) {
                            CKEDITOR.instances.isi_berita_en.setData(response.text);
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