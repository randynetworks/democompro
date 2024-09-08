@extends('cms.layout.index')
@section('judul', 'Struktur Organisasi')
@section('sub-judul', 'Manajemen Tentang Kami')
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
                            <form id="form-create-direksi" class="form" action="{{ route('struktur_organisasi.store') }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Nama</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="nama" id="nama" placeholder="Masukan Nama"  >
                                        </div>
                                        <div class="col-md-12">

                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Tagline</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="tagline" id="tagline" placeholder="Masukan tagline"  >

                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Tagline (Bahasa Inggris)</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="tagline_en" id="tagline_en" placeholder="Masukan tagline bahasa inggris"  >
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Jabatan</span>
                                            </label>
                                            <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jabatan" name="id_jabatan_fk" id="id_jabatan_fk">
                                                <option></option>
                                                @foreach ($data_jabatan as $i)
                                                    <Option value="{{ $i->id }}">{{ $i->jabatan}}</Option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">File Gambar</span>
                                            </label>
                                            <input type="file" class="form-control mb-4 mr-4" name="gambar" id="gambar" onchange="previewImage(event)" >
                                        </div>
                                        <img src="" alt="" style="max-height: 300px; width: 100%; display: none;" id="image-preview-img">
                                    </div>
                                    <div class="col-8">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class=" ">Deskripsi</span>
                                            </label>
                                            <textarea name="deskripsi" id="deskripsi" cols="20" rows="5" class="form-control" placeholder="Masukan Deskripsi"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class=" mt-3">Deskripsi (Bahasa Inggris)</span>
                                            </label>
                                            <textarea name="deskripsi_en" id="deskripsi_en" cols="20" rows="5" class="form-control" placeholder="Masukan Deskripsi (Bahasa Inggris)"></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="d-flex justify-content-end m-4">
                                    <a href="{{ route('struktur_organisasi') }}" class="btn btn-danger me-3">Kembali</a>
                                    <button id="submit_create_direksi" type="submit" class="btn btn-primary">
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
        CKEDITOR.replace('deskripsi');
        CKEDITOR.replace('deskripsi_en');
        validasi();
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-create-direksi');
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
                    // 'nama': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Nama harus diisi.'
                    //             },
                    //             stringLength: {
                    //                 min: 3, // Panjang minimum
                    //                 max: 255, // Panjang maksimum
                    //                 message: 'Nama harus antara 3 hingga 255 karakter.'
                    //             }
                    //         }
                    // },
                    'id_jabatan_fk': {
                            validators: {
                                callback:{
                                    callback:(input) => {
                                        // const elemenSelect = document.querySelector('#form-create-direksi > div.row.fv-plugins-icon-container > div.col-8 > div:nth-child(2) > span > span.selection > span');
                                        const elemenSelect = document.querySelector('#form-create-direksi > div.row.fv-plugins-icon-container > div.col-4 > div:nth-child(2) > span > span.selection > span');

                                        if(input.value == ''){
                                            elemenSelect.classList.remove('is-valid');
                                            elemenSelect.classList.add('is-invalid');
                                            return{
                                                valid: false,
                                                message: 'Jabatan harus dipilih.'
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
        const submitButton = document.getElementById('submit_create_direksi');
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
            var deskripsi_en = CKEDITOR.instances.deskripsi;
            var deskripsi = deskripsi_en.getData();
            var tagline = document.getElementById('tagline').value;

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
                            translateBtn.textContent = 'Translate';
                            translateBtn.style.pointerEvents = 'auto';
                        }
                    });
                    $.ajax({
                        url: "{{ route('translate') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            text: tagline
                        },
                        success: function(response) {
                            $('#tagline_en').val(response.text);
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
