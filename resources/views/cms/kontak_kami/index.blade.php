@extends('cms.layout.index')
@section('judul', 'Kontak Kami')
@section('sub-judul', 'Manajemen Kontak Kami')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<div id="kt_content_container" class="container-xxl">
			<div class="row gy-5 g-xl-10">
				<div class="col-xl-12 mb-5 mb-xl-10">
					<div class="card card-flush h-xl-100">
						<div class="card-header pt-5">
							<h3 class="card-title align-items-start flex-column">
							</h3>
                            <button id="edit_kontak" class="btn btn-warning" style="height: 40px;" onclick="edit()">
                                <span class="indicator-label">Edit</span>
                            </button>
						</div>
						<div class="card-body pb-0 pt-4">
                            <form id="form-edit-kontak" class="form" action="{{ route('kontak-kami.update', 1) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">                    
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Email Perusahaan</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="email" id="email" placeholder="Masukan Email Perusahaan" value="{{$data->email}}" disabled >
                                        </div>                                         
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Nomor Telepon</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="phone" id="phone" placeholder="Masukan Nomor Telepon" value="{{$data->phone}}" disabled >
                                        </div> 
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Username Instagram</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="instagram" id="instagram" placeholder="Masukan Username Instagram" value="{{$data->instagram}}" disabled >
                                        </div>       
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Instagram URL</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="url_instagram" id="url_instagram" placeholder="Masukan URL Instagram" value="{{$data->url_instagram}}" disabled >
                                        </div>           
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Alamat</span>
                                            </label>
                                            <textarea name="location" id="location" cols="30" rows="5" class="form-control" disabled  placeholder="Masukan Alamat">{{$data->location}}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Maps URL</span>
                                            </label>                                           
                                            <p class="m-2">URL diambil dari <a href="https://www.google.com/maps/ " target="_blank">sini.</a></p>
                                            <textarea name="maps" id="maps" cols="30" rows="5" class="form-control" disabled  placeholder="Masukan URL">{{$data->maps}}</textarea>
                                            <p class="m-2"><b>Petunjuk : Cari Lokasi, Bagikan, Copy link to share dan Paste disini.</b></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end m-4">
                                    <button id="submit_edit_kontak" class="btn btn-primary" style="display: none;">
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
        const form = document.getElementById('form-edit-kontak');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'Email Perusahaan harus diisi.'
                            },
                            emailAddress: { // validasi apakah email atau bukan
                                message: 'Masukkan email yang valid.'
                            }
                        }
                    },
                    'phone': {
                        validators: {
                            notEmpty: {
                                message: 'Nomor Telepon harus diisi.'
                            },
                        }
                    },
                    'location': {
                            validators: {
                                notEmpty: {
                                    message: 'Alamat harus diisi.'
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
        const submitButton = document.getElementById('submit_edit_kontak');
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

    // disabled false ketika button edit di klik
    function edit() {
        document.getElementById('email').disabled = false;
        document.getElementById('phone').disabled = false;
        document.getElementById('location').disabled = false;
        document.getElementById('maps').disabled = false;
        document.getElementById('instagram').disabled = false;
        document.getElementById('url_instagram').disabled = false;
        document.getElementById('edit_kontak').disabled = true;
        document.getElementById('submit_edit_kontak').style.display = 'inline-block';
    }
</script>
@endsection