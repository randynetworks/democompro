@extends('cms.layout.index')
@section('judul', 'Profil Perusahaan')
@section('sub-judul', 'Manajemen Perusahaan')
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
							<h3 class="card-title align-items-start flex-column">
							</h3>
                            <div class="ms-auto ">
                                <button id="edit_profil" class="btn btn-sm btn-warning" onclick="edit()">
                                    <span class="indicator-label">Edit</span>
                                </button>
                                <button class="btn btn-sm btn-primary" id="translateBtn" style="display: none;"><i class="bi bi-translate"></i> Translate</button>
                            </div>
                            <div id="translateBtn_tooltips" style="display: none;">
                                <i class="fas fa-exclamation-circle ms-2 fs-7 mt-1" data-bs-toggle="tooltip" title="Tombol ini untuk memanggil fungsi Translate ke Bahasa Inggris secara otomatis." ></i>
                            </div>
						</div>
						<div class="card-body pb-0 pt-4">
                            <form id="form-edit-profil" class="form" action="{{ route('profil-perusahaan.update', $data->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span>Nama Perusahaan</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="nama_perusahaan" id="nama_perusahaan" placeholder="Masukan Nama Perusahaan" value="{{$data->nama_perusahaan}}" disabled >
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">URL Youtube</span> 
                                            </label>
                                            <div class="input-group mb-4">
                                                <input type="text" class="form-control mr-4" name="url_youtube" id="url_youtube" placeholder="Masukan URL Youtube" value="{{$data->url_youtube}}" disabled data-id="{{$data->id}}">
                                                <span class="input-group-text">
                                                    <!-- <i class="bi {{ $data->status_youtube ? 'bi-eye' : 'bi-eye-slash' }}" id="eye-icon"  onclick="toggleVisibility('url_youtube')"></i> -->
                                                    <input type="checkbox" id="cek_youtube" class="status-checkbox" data-id="{{ $data->id }}" {{ $data->status_youtube ? 'checked' : '' }}>
                                                </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7 mt-5" data-bs-toggle="tooltip" title="CheckBox ini untuk mengatur mana aset yang akan ditampilkan pada halaman Tentang Kami." style="align-items: center;"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">File Gambar</span>
                                            </label>
                                            <div class="input-group mb-4">
                                                <input type="file" class="form-control mr-4" name="gambar" id="gambar" onchange="previewImage(event)" value="{{$data->gambar}}" disabled>
                                                <span class="input-group-text">
                                                    <!-- <i class="bi {{ $data->status_gambar ? 'bi-eye' : 'bi-eye-slash' }}" id="eye-icon" onclick="toggleVisibility('gambar')"></i> -->
                                                    <input type="checkbox" id="cek_gambar" class="status-checkbox" data-id="{{ $data->id }}" {{ $data->status_gambar ? 'checked' : '' }}>
                                                </span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7 mt-5" data-bs-toggle="tooltip" title="CheckBox ini untuk mengatur mana aset yang akan ditampilkan pada halaman Tentang Kami." style="align-items: center;"></i>
                                            </div>
                                        </div>

                                        <img src="{{ asset('images/profil_perusahaan/' . $data->gambar) }}" alt="" style="max-height: 300px; width: 100%;" id="image-preview-img" onerror="this.style.display='none'">
                                        <!-- <img src="{{ asset($data->imageExists ? 'images/profil_perusahaan/' . $data->gambar : 'images/no-image.png') }}" style="max-height: 300px; width: 100%;" id="image-preview-img"> -->
                                    </div>
                                    <div class="col-8">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Deskripsi</span>
                                            </label>
                                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control" disabled placeholder="Masukan Deskripsi" >{{$data->deskripsi}}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="mt-3">Deskripsi (Bahasa Inggris)</span>
                                            </label>
                                            <textarea name="deskripsi_en" id="deskripsi_en" cols="30" rows="5" class="form-control" disabled placeholder="Masukan Deskripsi (Bahasa Inggris)" >{{$data->deskripsi_en}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end m-4">
                                    <button id="submit_edit_profil" class="btn btn-primary" style="display: none;">
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
        CKEDITOR.replace('deskripsi', { readOnly: true });
        CKEDITOR.replace('deskripsi_en', { readOnly: true });
        validasi();
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-edit-profil');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
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
                    'url_youtube': {
                            validators: {
                                notEmpty: {
                                    message: 'URL harus diisi.'
                                },
                            }
                    },
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
        const submitButton = document.getElementById('submit_edit_profil');
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

    function edit() {
        document.getElementById('gambar').disabled = false;
        document.getElementById('url_youtube').disabled = false;
        document.getElementById('nama_perusahaan').disabled = false;
        document.getElementById('deskripsi').disabled = false;
        document.getElementById('deskripsi_en').disabled = false;
        CKEDITOR.instances.deskripsi.setReadOnly(false);
        CKEDITOR.instances.deskripsi_en.setReadOnly(false);
        document.getElementById('edit_profil').style.display = 'none';
        document.getElementById('translateBtn').style.display = 'inline-block';
        document.getElementById('translateBtn_tooltips').style.display = 'inline-block';
        document.getElementById('submit_edit_profil').style.display = 'inline-block';
    }

    $('#form-edit-profil').on('change', '.status-checkbox', function() {
        var checkbox = $(this);
        var id = checkbox.data('id');
        var status = checkbox.is(':checked') ? 1 : 0;
        var otherCheckboxId = checkbox.attr('id') === 'cek_youtube' ? '#cek_gambar' : '#cek_youtube';

        // Update the other checkbox
        $(otherCheckboxId).prop('checked', !checkbox.is(':checked'));

        $.ajax({
            url: "{{ route('profil-perusahaan.updateStatus', '') }}" + '/' + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            error: function(xhr) {
                console.log('Error updating status');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('translateBtn').addEventListener('click', translate);

        function translate() {
            // var deskripsi = document.getElementById('deskripsi').value;
            var editorInstance = CKEDITOR.instances.deskripsi;
    
            // Get the current data from CKEditor
            var deskripsi = editorInstance.getData();
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
                            text: deskripsi
                        },
                        success: function(response) {
                            CKEDITOR.instances.deskripsi_en.setData(response.text);
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
