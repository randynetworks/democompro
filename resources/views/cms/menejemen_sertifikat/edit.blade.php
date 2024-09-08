@extends('cms.layout.index')
@section('judul', 'Penghargaan')
@section('content')

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
                                <form id="form-edit-sertifikat" class="form"
                                    action="{{ route('sertifikat-prestasi.update', $data->id) }}" autocomplete="off"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Nama</span>
                                                </label>
                                                <input type="text" class="form-control mb-4 mr-4" name="nama"
                                                    id="nama" placeholder="Masukan Nama" value="{{ $data->nama }}">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Nama (Bahasa Inggris)</span>
                                                </label>
                                                <input type="text" class="form-control mb-4 mr-4" name="nama_en"
                                                    id="nama_en" placeholder="Masukan Nama (Bahasa Inggris)" value="{{ $data->nama_en }}">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">File Gambar</span>
                                                </label>
                                                <input type="file" class="form-control mb-4 mr-4" name="gambar"
                                                    id="gambar" onchange="previewImage(event)">
                                            </div>
                                            <img src="{{ asset('/images/sertifikat/' . $data->gambar) }}" alt=""
                                                style="max-height: 300px;" id="image-preview-img">
                                        </div>
                                        <div class="col-6">
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Kategori</span>
                                                </label>
                                                <select class="form-select mb-2" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Masukan Kategori"
                                                    name="kategori" id="kategori">
                                                    <option></option>
                                                    <option value="1"
                                                        @if ($data->kategori == 1) selected="" @endif>Sertifikasi
                                                    </option>
                                                    <option value="2"
                                                        @if ($data->kategori == 2) selected="" @endif>Penghargaan
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Waktu</span>
                                                </label>
                                                <input class="form-control mb-4 mr-4 date" name="waktu" id="waktu"
                                                    value="{{ $data->waktu }}" placeholder="Masukan Waktu">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end m-4">
                                        <a href="{{ route('sertifikat-prestasi') }}" class="btn btn-danger me-3">Kembali</a>
                                        <button id="submit_sertifikat" type="submit" class="btn btn-primary">
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
            // flatpicker
            $(".date").flatpickr({
                enableTime: !0,
                dateFormat: "Y-m-d H:i",
                inline: true
            });
        });

        // validasi inputan kosong
        function validasi() {
            const form = document.getElementById('form-edit-sertifikat');
            
            // Check if the image file exists
            // const imageUrl = '/images/sertifikat/' + form.elements['gambar'].value; // Adjust the path as per your application
            // const fileExists = checkFileExists(imageUrl);

            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'gambar': {
                            validator: {                                
                                file: {
                                    extension: 'jpeg,jpg,png,gif', // Allowed image file extensions
                                    type: 'image/jpeg,image/png,image/gif', // Allowed MIME types
                                    maxSize: 2097152, // 2048 * 1024 (2MB)
                                    message: 'Hanya bisa upload file gambar (jpeg, jpg, png, gif) dengan ukuran maksimal 2MB.',
                                },
                            }
                        },
                        'nama': {
                            validators: {
                                notEmpty: {
                                    message: 'Nama harus diisi.'
                                },
                                stringLength: {
                                    min: 3, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Nama harus antara 3 hingga 255 karakter.'
                                }
                            }
                        },
                        'nama_en': {
                            validators: {
                                notEmpty: {
                                    message: 'Nama (Bahasa Inggris) harus diisi.'
                                },
                                stringLength: {
                                    min: 3, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Nama (Bahasa Inggris) harus antara 3 hingga 255 karakter.'
                                }
                            }
                        },
                        'kategori': {
                            validators: {
                                callback:{
                                    callback:(input) => {
                                        const elemenSelect = document.querySelector(' #form-edit-sertifikat > div.row.fv-plugins-icon-container > div.col-8 > div:nth-child(3) > span > span.selection > span');
                                        
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
                        'waktu': {
                            validators: {
                                notEmpty: {
                                    message: 'Waktu harus diisi.'
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
            const submitButton = document.getElementById('submit_sertifikat');
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
            
            // Activate file validation only if file does not exist
            // if (!fileExists) {
            //     validator.addField('gambar', {
            //         validators: {                    
            //             notEmpty: {
            //                 message: 'Gambar harus diisi.'
            //             },
            //             file: {
            //                 extension: 'jpeg,jpg,png,gif', // Allowed image file extensions
            //                 type: 'image/jpeg,image/png,image/gif', // Allowed MIME types
            //                 maxSize: 2097152, // 2048 * 1024 (2MB)
            //                 message: 'Hanya bisa upload file gambar (jpeg, jpg, png, gif) dengan ukuran maksimal 2MB.',
            //             },
            //         }
            //     });
            // }
        }

        // function checkFileExists(url) {
        //     var http = new XMLHttpRequest();
        //     http.open('HEAD', url, false);
        //     http.send();
        //     return http.status != 404;
        // }

        // preview gambar
        function previewImage(event) {
            var image = document.getElementById('image-preview-img');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.style.display = 'block';
        }

        
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('translateBtn').addEventListener('click', translate);

        function translate() {
            var nama = document.getElementById('nama').value;

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
                            text: nama
                        },
                        success: function(response) {
                            $('#nama_en').val(response.text);
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
