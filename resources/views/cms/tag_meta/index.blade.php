@extends('cms.layout.index')
@section('judul', 'Manajemen Tag Meta')
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
                            <button id="edit_meta" class="btn btn-warning" style="height: 40px;" onclick="edit()">
                                <span class="indicator-label">Edit</span>
                            </button>
						</div>
						<div class="card-body pb-0 pt-4">
                            <form id="form-edit-meta" class="form" action="{{ route('manajemen-meta.update', $data->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">                    
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Title</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="title" id="title" placeholder="Masukan Title" value="{{$data->title}}" disabled>
                                        </div>                                 
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Deskripsi</span>
                                            </label>
                                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control" disabled placeholder="Masukan Meta Deskripsi">{{$data->deskripsi}}</textarea>
                                        </div>                         
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required mt-3">Keywords</span>
                                            </label>
                                            <textarea name="keyword" id="keyword" cols="30" rows="5" class="form-control" disabled placeholder="Masukan Meta Keywords">{{$data->keyword}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end m-4">
                                    <button id="submit_edit_meta" class="btn btn-primary" style="display: none;">
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
        const form = document.getElementById('form-edit-meta');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'title': {
                            validators: {
                                notEmpty: {
                                    message: 'Title harus diisi.'
                                },
                            }
                    },
                    'dekripsi': {
                            validators: {
                                notEmpty: {
                                    message: 'Meta Deskripsi harus diisi.'
                                },
                            }
                    },
                    'keyword': {
                            validators: {
                                notEmpty: {
                                    message: 'Meta Keywords harus diisi.'
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
        const submitButton = document.getElementById('submit_edit_meta');
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

    // button 
    function edit() {
        document.getElementById('title').disabled = false;
        document.getElementById('deskripsi').disabled = false;
        document.getElementById('keyword').disabled = false;
        document.getElementById('edit_meta').disabled = true;
        document.getElementById('submit_edit_meta').style.display = 'inline-block';
    }

</script>
@endsection