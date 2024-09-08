@extends('cms.layout.index')
@section('judul', 'Menu Lainnya')
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
                                <form id="form-edit-menu" class="form" action="{{ route('menu-dinamis.update', $data->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Navbar</span>
                                                </label>
                                                <input type="text" class="form-control mb-4 mr-4" name="navbar"
                                                    id="navbar" placeholder="Masukan Judul untuk Navbar" value="{{$data->navbar}}">
                                            </div>
                                            <div class="col-md-12">                                                
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required mt-3">Deskripsi</span>
                                                </label>
                                                <textarea name="deskripsi" id="deskripsi" cols="20" rows="5" class="form-control" placeholder="Masukan Deskripsi">{{$data->deskripsi}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Navbar (Bahasa Inggris)</span>
                                                </label>
                                                <input type="text" class="form-control mb-4 mr-4" name="navbar_en"
                                                    id="navbar_en" placeholder="Masukan Judul untuk Navbar (Bahasa Inggris)" value="{{$data->navbar_en}}">
                                            </div>
                                            <div class="col-md-12">                                                
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required mt-3">Deskripsi (Bahasa Inggris)</span>
                                                </label>
                                                <textarea name="deskripsi_en" id="deskripsi_en" cols="20" rows="5" class="form-control" placeholder="Masukan Deskripsi (Bahasa Inggris)">{{$data->deskripsi_en}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="col-md-12 mt-4">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Body</span>
                                                </label>         
                                                <p class="m-2">Kode HTML yang diinput akan digenerasi di dalam <span style="font-weight: bold;">body > section</span></a></p>                                          
                                                <textarea name="body" id="body" placeholder="Masukan Code HTML untuk body" class="mb-2 form-control" style="height: 150px;">{{$data->body}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end m-4">
                                        <a href="{{ route('menu-dinamis') }}" class="btn btn-danger me-3">Kembali</a>
                                        <button id="submit_menu" type="submit" class="btn btn-primary">
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
            CKEDITOR.replace('body',{
                enterMode: CKEDITOR.ENTER_DIV, // Menggunakan <div> sebagai tag default
                shiftEnterMode: CKEDITOR.ENTER_BR,
            });
            validasi();
        });

        // validasi inputan kosong
        function validasi() {
            const form = document.getElementById('form-edit-menu');
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'navbar': {
                            validators: {
                                notEmpty: {
                                    message: 'Judul untuk Navbar harus diisi.'
                                },
                                stringLength: {
                                    min: 3, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Nama harus antara 3 hingga 255 karakter.'
                                }
                            }
                        },
                        'navbar_en': {
                            validators: {
                                notEmpty: {
                                    message: 'Judul untuk Navbar (Bahasa Inggris) harus diisi.'
                                },
                                stringLength: {
                                    min: 3, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Nama harus antara 3 hingga 255 karakter.'
                                }
                            }
                        },
                        'deskripsi': {
                            validators: {
                                notEmpty: {
                                    message: 'Deskripsi harus diisi.'
                                },
                            }
                        },
                        'deskripsi_en': {
                            validators: {
                                notEmpty: {
                                    message: 'Deskripsi (Bahasa Inggris) harus diisi.'
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
            const submitButton = document.getElementById('submit_menu');
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
                console.log(1);
                var nama = document.getElementById('navbar').value;
                var deskripsi = document.getElementById('deskripsi').value;

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
                                text: navbar
                            },
                            success: function(response) {
                                $('#navbar_en').val(response.text);
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
                                $('#deskripsi_en').val(response.text);
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
