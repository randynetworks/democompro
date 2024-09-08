@extends('cms.layout.index')
@section('judul', 'Nilai by Gambar')
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
                            </div>
						</div>
						<div class="card-body pb-0 pt-4">
                            <form id="form-edit-nilai-gambar" class="form" action="{{ route('manajemen-nilai.update_gambar', $data->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12"> 
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >File Gambar</span>
                                            </label>
                                            <input type="file" class="form-control mb-4 mr-4" name="gambar" id="gambar" onchange="previewImage(event)" value="{{$data->gambar}}" disabled >
                                        </div>
                                        <img src="{{ asset('images/nilai_by_gambar/' . $data->gambar) }}" style="max-height: 300px; max-width: 900px" id="image-preview-img" onerror="this.style.display='none'">
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end m-4">
                                    <button id="submit_edit_nilai_gambar" class="btn btn-primary" style="display: none;">
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
        const form = document.getElementById('form-edit-nilai-gambar');

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
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    bootstrap: new FormValidation.plugins.Bootstrap5()
                }
            }
        );

        const submitButton = document.getElementById('submit_edit_nilai_gambar');
        submitButton.addEventListener('click', function(e) {
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

    function edit() {
        document.getElementById('gambar').disabled = false;
        document.getElementById('edit_ucapan').style.display = 'none';
        document.getElementById('submit_edit_nilai_gambar').style.display = 'inline-block';
    }
</script>
@endsection