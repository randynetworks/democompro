@extends('cms.layout.index')
@section('judul', 'Visi & Misi')
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
                                <button id="edit_visimisi" class="btn btn-sm btn-warning" onclick="edit()">
                                    <span class="indicator-label">Edit</span>
                                </button>
                                <button class="btn btn-sm btn-primary" id="translateBtn" style="display: none;"><i class="bi bi-translate"></i> Translate</button>
                            </div>
                            <div id="translateBtn_tooltips" style="display: none;">
                                <i class="fas fa-exclamation-circle ms-2 fs-7 mt-1" data-bs-toggle="tooltip" title="Tombol ini untuk memanggil fungsi Translate ke Bahasa Inggris secara otomatis." ></i>
                            </div>
						</div>
						<div class="card-body pb-0 pt-4">
                            <form id="form-edit-visimisi" class="form" action="{{ route('visi-misi.update', 1) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">                    
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="">Visi</span>
                                            </label>
                                            <textarea class="form-control mb-4 mr-4" name="visi" id="visi" placeholder="Masukan Visi Perusahaan" disabled>{{$data->visi}}</textarea>
                                        </div>                  
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class=" mt-4">Misi</span>
                                            </label>
                                            <textarea name="misi" id="misi" cols="30" rows="5" class="form-control" disabled placeholder="Masukan Misi perusahaan">{{$data->misi}}</textarea>
                                        </div>                         
                                    </div>   
                                    <div class="col-6">                              
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="">Visi (Bahasa Inggris)</span>
                                            </label>
                                            <textarea class="form-control mb-4 mr-4" name="visi_en" id="visi_en" placeholder="Masukan Visi Perusahaan (Bahasa Inggris)"  disabled>{{$data->visi_en}}</textarea>
                                        </div>  
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class=" mt-4">Misi (Bahasa Inggris)</span>
                                            </label>
                                            <textarea name="misi_en" id="misi_en" cols="30" rows="5" class="form-control" disabled placeholder="Masukan Misi perusahaan (Bahasa Inggris)">{{$data->misi_en}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end m-4">
                                    <button id="submit_edit_visimisi" class="btn btn-primary" style="display: none;">
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
        CKEDITOR.replace('visi', { readOnly: true });
        CKEDITOR.replace('visi_en', { readOnly: true });
        CKEDITOR.replace('misi', { readOnly: true });
        CKEDITOR.replace('misi_en', { readOnly: true });

        validasi();
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-edit-visimisi');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    // 'visi': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Visi harus diisi.'
                    //             },
                    //         }
                    // },
                    // 'visi_en': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Visi (Bahasa Inggris) harus diisi.'
                    //             },
                    //         }
                    // },
                    // 'misi': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Misi harus diisi.'
                    //             },
                    //         }
                    // },
                    // 'misi_en': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Misi (Bahasa Inggris) harus diisi.'
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
        const submitButton = document.getElementById('submit_edit_visimisi');
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

    // button 
    function edit() {
        document.getElementById('visi').disabled = false;
        document.getElementById('visi_en').disabled = false;
        CKEDITOR.instances.visi.setReadOnly(false);
        CKEDITOR.instances.visi_en.setReadOnly(false);
        document.getElementById('misi').disabled = false;
        document.getElementById('misi_en').disabled = false;
        CKEDITOR.instances.misi.setReadOnly(false);
        CKEDITOR.instances.misi_en.setReadOnly(false);
        document.getElementById('edit_visimisi').style.display = 'none';
        document.getElementById('translateBtn').style.display = 'inline-block';
        document.getElementById('translateBtn_tooltips').style.display = 'inline-block';
        document.getElementById('submit_edit_visimisi').style.display = 'inline-block';
    }

    
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('translateBtn').addEventListener('click', translate);

        function translate() {
            var visi_en = CKEDITOR.instances.visi;
            var visi = visi_en.getData();
            var misi_en = CKEDITOR.instances.misi;
            var misi = misi_en.getData();

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
                            text: visi
                        },
                        success: function(response) {
                            CKEDITOR.instances.visi_en.setData(response.text);
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
                            text: misi
                        },
                        success: function(response) {
                            CKEDITOR.instances.misi_en.setData(response.text);
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