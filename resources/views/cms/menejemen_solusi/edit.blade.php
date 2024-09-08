@extends('cms.layout.index')
@section('judul', 'Manajemen Solusi')
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
						<div class="card-body pb-0 pt-5">
                            <form id="form-add-solusi" class="form" action="{{ route('manajemen-solusi.update', $dataDetail->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Kategori</span>
                                            </label>
                                            @php
                                                $categories = [
                                                    'Reasuransi Jiwa Syariah',
                                                    'Reasuransi Umum Syariah',
                                                    'Mitra Bisnis'
                                                ];
                                            @endphp
                                            <select class="form-select mb-2" data-control="select2"
                                                data-hide-search="true" data-placeholder="Masukan Kategori"
                                                name="kategori" id="kategori">
                                                <option></option>
                                                @foreach($categories as $index => $category)
                                                    <option value="{{ $index+1 }}" @if ($data->kategori == $category) selected="" @endif>{{ $category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Judul</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="judul" id="judul" placeholder="Masukan Judul" value="{{$dataDetail->judul}}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Deskripsi</span>
                                            </label>
                                            <textarea class="form-control mb-4 mr-4" name="deskripsi" id="deskripsi" placeholder="Masukan Deskripsi">{{$dataDetail->deskripsi}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Judul (Bahasa Inggris)</span>
                                            </label>
                                            <input type="text" class="form-control mb-4 mr-4" name="judul_en" id="judul_en" placeholder="Masukan Judul (Bahasa Inggris)" value="{{$dataDetail->judul_en}}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span >Deskripsi (Bahasa Inggris)</span>
                                            </label>
                                            <textarea class="form-control mb-4 mr-4" name="deskripsi_en" id="deskripsi_en" placeholder="Masukan Deskripsi (Bahasa Inggris)">{{$dataDetail->deskripsi_en}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end m-4">
                                    <a href="{{ route('manajemen-solusi') }}" class="btn btn-danger me-3">Kembali</a>
                                    <button id="submit_solusi" type="submit" class="btn btn-primary">
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
        const form = document.getElementById('form-add-solusi');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'kategori': {
                        validators: {
                            callback:{
                                callback:(input) => {
                                    const elemenSelect = document.querySelector('#form-add-solusi > div.row.fv-plugins-icon-container > div.col-12 > div > span > span.selection > span');

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
                        }
                    },
                    // 'judul': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Harus diisi.'
                    //             },
                    //             stringLength: {
                    //                 min: 3, // Panjang minimum
                    //                 max: 255, // Panjang maksimum
                    //                 message: 'Inputan harus antara 3 hingga 255 karakter.'
                    //             }
                    //         }
                    // },
                    // 'judul_en': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Harus diisi.'
                    //             },
                    //             stringLength: {
                    //                 min: 3, // Panjang minimum
                    //                 max: 255, // Panjang maksimum
                    //                 message: 'Inputan harus antara 3 hingga 255 karakter.'
                    //             }
                    //         }
                    // },
                    // 'deskripsi': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Harus diisi.'
                    //             },
                    //         }
                    // },
                    // 'deskripsi_en': {
                    //         validators: {
                    //             notEmpty: {
                    //                 message: 'Harus diisi.'
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
        const submitButton = document.getElementById('submit_solusi');
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

    document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('translateBtn').addEventListener('click', translate);

            function translate() {
                var judul = document.getElementById('judul').value;
                // var deskripsi = document.getElementById('deskripsi').value;
                var deskripsi_en = CKEDITOR.instances.deskripsi;
                var deskripsi = deskripsi_en.getData();

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
                                text: deskripsi
                            },
                            success: function(response) {
                                // $('#deskripsi_en').val(response.text);
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
