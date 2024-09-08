@extends('cms.layout.index')
@section('judul', 'Ucapan Selamat Datang')
@section('sub-judul', 'Manajemen Beranda')
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
                                <button id="edit_ucapan" class="btn btn-sm btn-warning" onclick="edit()">
                                    <span class="indicator-label">Edit</span>
                                </button>
                                <button class="btn btn-sm btn-primary" id="translateBtn" style="display: none;"><i class="bi bi-translate"></i> Translate</button>
                            </div>
                            <div id="translateBtn_tooltips">
                                <i class="fas fa-exclamation-circle ms-2 fs-7 mt-1" data-bs-toggle="tooltip" title="Tombol ini untuk memanggil fungsi Translate ke Bahasa Inggris secara otomatis." style="display: none;"></i>
                            </div>
						</div>
						<div class="card-body pb-0 pt-4">
                            <form id="form-edit-ucapan" class="form" action="{{ route('manajemen-ucapan.update', $id_ucapan->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">                      
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Nama</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="nama" id="nama" placeholder="Masukan Nama" value="{{$data->nama}}" disabled >
                                        </div>  
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Level - Jabatan</span>
                                            </label>
                                            <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Masukan Level - Jabatan" name="id_jabatan_fk" id="id_jabatan_fk" disabled >
                                                <option></option>
                                                @foreach ($data_jabatan as $i)
                                                    <Option value="{{ $i->id }}" @if ($data->id_jabatan_fk == $i->id) selected="" @endif>Level {{$i->level}} - {{ $i->jabatan}}</Option>
                                                @endforeach
                                            </select>
                                        </div>                                                               
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Tagline</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="tagline" id="tagline" placeholder="Masukan Tagline" value="{{$data->tagline}}" disabled >
                                        </div>                                                                                                  
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Tagline (Bahasa Inggris)</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="tagline_en" id="tagline_en" placeholder="Masukan Tagline (Bahasa Inggris)" value="{{$data->tagline_en}}" disabled >
                                        </div>                                                                                                                                                
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >File Gambar</span>
                                            </label>
                                            <input type="file" class="form-control mb-4 mr-4" name="gambar" id="gambar" onchange="previewImage(event)" value="{{$data->gambar}}" disabled >
                                        </div>
                                        <img src="{{ asset('images/ucapan/' . $data->gambar) }}" style="max-height: 300px; width: 100%;" id="image-preview-img" onerror="this.style.display='none'">
                                        <!-- <img src="{{ asset($data->imageExists ? 'images/ucapan/' . $data->gambar : 'images/no-image.png') }}" style="max-height: 300px; width: 100%;" id="image-preview-img"> -->

                                    </div>
                                    <div class="col-8">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="mt-3">Deskripsi</span>
                                            </label>
                                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control" disabled  placeholder="Masukan Deskripsi">{{$data->deskripsi}}</textarea>
                                        </div>                    
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="mt-3">Deskripsi (Bahasa inggris)</span>
                                            </label>
                                            <textarea name="deskripsi_en" id="deskripsi_en" cols="30" rows="3" class="form-control" disabled  placeholder="Masukan Deskripsi (Bahasa Inggris)">{{$data->deskripsi_en}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end m-4">
                                    <button id="submit_edit_ucapan" class="btn btn-primary" style="display: none;">
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
        CKEDITOR.replace('deskripsi', {
            readOnly: true,
            extraPlugins: 'justify', // Tambahkan plugin justify
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] }
            ]
        });
        CKEDITOR.replace('deskripsi_en', {
            readOnly: true,
            extraPlugins: 'justify', // Tambahkan plugin justify
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] }
            ]
        });

        validasi();
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-edit-ucapan');
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
                    'id_jabatan_fk': {
                            validators: {
                                notEmpty: {
                                    message: 'Jabatan harus diisi.'
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
        const submitButton = document.getElementById('submit_edit_ucapan');
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
        document.getElementById('nama').disabled = false;
        document.getElementById('tagline').disabled = false;
        document.getElementById('tagline_en').disabled = false;
        document.getElementById('id_jabatan_fk').disabled = false;
        document.getElementById('deskripsi').disabled = false;
        document.getElementById('deskripsi_en').disabled = false;
        CKEDITOR.instances.deskripsi.setReadOnly(false);
        CKEDITOR.instances.deskripsi_en.setReadOnly(false);
        document.getElementById('edit_ucapan').style.display = 'none';
        document.getElementById('translateBtn').style.display = 'inline-block';
        document.getElementById('translateBtn_tooltips').style.display = 'inline-block';
        document.getElementById('submit_edit_ucapan').style.display = 'inline-block';
    }

    
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('translateBtn').addEventListener('click', translate);

        function translate() {
            var tagline = document.getElementById('tagline').value;

            var editorInstance = CKEDITOR.instances.deskripsi;
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