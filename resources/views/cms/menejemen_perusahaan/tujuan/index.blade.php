@extends('cms.layout.index')
@section('judul', 'Tujuan Perusahaan')
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
                                <button id="edit_tujuan" class="btn btn-sm btn-warning" onclick="edit()">
                                    <span class="indicator-label">Edit</span>
                                </button>
                                <button class="btn btn-sm btn-primary" id="translateBtn" style="display: none;"><i class="bi bi-translate"></i> Translate</button>
                            </div>
                            <div id="translateBtn_tooltips" style="display: none;">
                                <i class="fas fa-exclamation-circle ms-2 fs-7 mt-1" data-bs-toggle="tooltip" title="Tombol ini untuk memanggil fungsi Translate ke Bahasa Inggris secara otomatis." ></i>
                            </div>
						</div>
						<div class="card-body pb-0 pt-4">
                            <form id="form-edit-tujuan" class="form" action="{{ route('tujuan-perusahaan.update', 1) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">  
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class=" mt-3">Tujuan Perusahaan</span>
                                            </label>
                                            <textarea name="tujuan" id="tujuan" cols="30" rows="10" class="form-control" disabled placeholder="Masukan Tujuan Deskripsi">{{$data->tujuan}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">  
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class=" mt-3">Tujuan Perusahaan (Bahasa Inggris)</span>
                                            </label>
                                            <textarea name="tujuan_en" id="tujuan_en" cols="30" rows="10" class="form-control" disabled placeholder="Masukan Tujuan Deskripsi (Bahasa Inggris)">{{$data->tujuan_en}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end m-4">
                                    <button id="submit_edit_tujuan" class="btn btn-primary" style="display: none;">
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
        CKEDITOR.replace('tujuan', { readOnly: true });
        CKEDITOR.replace('tujuan_en', { readOnly: true });
        validasi();
    });

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-edit-tujuan');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    // 'tujuan': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Tujuan harus diisi.'
                    //             },
                    //         }
                    // },
                    // 'tujuan_en': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Tujuan (Bahasa Inggris) harus diisi.'
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
        const submitButton = document.getElementById('submit_edit_tujuan');
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
        document.getElementById('tujuan').disabled = false;
        document.getElementById('tujuan_en').disabled = false;
        CKEDITOR.instances.tujuan.setReadOnly(false);
        CKEDITOR.instances.tujuan_en.setReadOnly(false);
        document.getElementById('edit_tujuan').style.display = 'none';
        document.getElementById('translateBtn').style.display = 'inline-block';
        document.getElementById('translateBtn_tooltips').style.display = 'inline-block';
        document.getElementById('submit_edit_tujuan').style.display = 'inline-block';
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('translateBtn').addEventListener('click', translate);

        function translate() {
            var tujuan_en = CKEDITOR.instances.tujuan;
            var tujuan = tujuan_en.getData();

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
                            text: tujuan
                        },
                        success: function(response) {
                            CKEDITOR.instances.tujuan_en.setData(response.text);
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