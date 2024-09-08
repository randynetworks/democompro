@extends('cms.layout.index')
@section('judul', 'Karir')
@section('sub-judul', 'Manajemen Beranda')
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
                            <button id="edit_karir" class="btn btn-warning" style="height: 40px;" onclick="edit()">
                                <span class="indicator-label">Edit</span>
                            </button>
						</div>
						<div class="card-body pb-0 pt-4">
                            <form id="form-edit-karir" class="form" action="{{ route('manajemen-karir.update', 1) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">                                    
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Link </span>
                                            </label>
                                            <textarea name="url" id="url"  rows="5" class="form-control" disabled placeholder="Masukan Link ">{{$data->url}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end m-4">
                                    <button id="submit_edit_karir" class="btn btn-primary" style="display: none;">
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
        const form = document.getElementById('form-edit-karir');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'url': {
                        validators: {
                            notEmpty: {
                                message: 'Link harus diisi.'
                            },
                            uri: {
                                message: 'Harap masukkan URL yang valid.'
                            }
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
        const submitButton = document.getElementById('submit_edit_karir');
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

    function edit() {
        document.getElementById('url').disabled = false;
        document.getElementById('edit_karir').disabled = true;
        document.getElementById('submit_edit_karir').style.display = 'inline-block';
    }
</script>
@endsection