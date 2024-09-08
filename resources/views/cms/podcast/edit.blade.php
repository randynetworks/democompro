@extends('cms.layout.index')
@section('judul', 'Podcast')
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
                                <form id="form-add-podcast" class="form"
                                    action="{{ route('video.update', $data->id) }}" autocomplete="off" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-2">
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Video</span>
                                                </label>
                                                <select class="form-select mb-5" name="inputType" id="inputType" aria-label="Pilih Kategori" style="width: 150px;">
                                                    <option value="youtube_link" @if (!empty($data->youtube_link)) selected="" @endif>YouTube Link</option>
                                                    <option value="video_file" @if (!empty($data->video_file)) selected="" @endif>Video File</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-10">
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-9">
                                                    <!-- <span>Inputan</span> -->
                                                </label>
                                                <input type="text" class="form-control mb-5" name="youtube_link" id="youtube_link" placeholder="Masukan Link YouTube" value="{{$data->youtube_link}}">
                                                <input type="file" class="form-control mb-5 d-none" name="video_file" id="video_file">
                                                @if($data->video_file != NULL)
                                                <a href="{{ asset('images/podcast/' . $data->video_file) }}" target="_blank" class="d-none" id="video_file_preview">Lihat File</a>
                                                @endif
                                                <div id="error-message" class="text-danger d-none">Video harus diisi.</div>
                                            </div>
                                        </div>
                                        <div class="col-6">                                            
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span>Judul</span>
                                                </label>
                                                <textarea class="form-control mb-4 mr-4 date" name="judul" id="judul" placeholder="Masukan Judul">{{$data->judul}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-md-12">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span>Judul (Bahasa Inggris)</span>
                                                </label>
                                                <textarea class="form-control mb-4 mr-4 date" name="judul_en" id="judul_en" placeholder="Masukan Judul (Bahasa Inggris)">{{$data->judul_en}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end m-4">
                                        <a href="{{ route('video') }}" class="btn btn-danger me-3">Kembali</a>
                                        <button id="submit_podcast" type="submit" class="btn btn-primary">
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
            const form = document.getElementById('form-add-podcast');
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'youtube_link': {
                            validators: {
                                uri: {
                                    message: 'Harap masukkan URL yang valid.'
                                }
                            }
                        },
                        'video_file': {
                            validators: {
                                file: {
                                    extension: 'mp4,avi,mov,wmv,flv', // Allowed video file extensions
                                    type: 'video/mp4,video/avi,video/quicktime,video/x-ms-wmv,video/x-flv', // Allowed MIME types
                                    // maxSize: 10485760, // 10MB in bytes (10 * 1024 * 1024)
                                    maxSize: 20971520, // 20MB in bytes (20 * 1024 * 1024)
                                    message: 'Hanya bisa upload file video (mp4, avi, mov, wmv, flv) dengan ukuran maksimal 20MB.',
                                },
                            }
                        },
                        'judul': {
                            validators: {
                                notEmpty: {
                                    message: 'Judul harus diisi.'
                                },
                                stringLength: {
                                    min: 3, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Judul harus antara 3 hingga 255 karakter.'
                                }
                            }
                        },
                        'judul_en': {
                            validators: {
                                notEmpty: {
                                    message: 'Judul (Bahasa Inggris) harus diisi.'
                                },
                                stringLength: {
                                    min: 3, // Panjang minimum
                                    max: 255, // Panjang maksimum
                                    message: 'Judul harus antara 3 hingga 255 karakter.'
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
            const submitButton = document.getElementById('submit_podcast');
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

        // preview gambar
        function previewImage(event) {
            var image = document.getElementById('image-preview-img');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.style.display = 'block';
        }

            
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('translateBtn').addEventListener('click', translate);

            function translate() {
                var judul = document.getElementById('judul').value;

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
                        
                    }
                });
            }
        });

        document.getElementById('inputType').addEventListener('change', function () { 
            const youtubeLinkInput = document.getElementById('youtube_link');
            const videoFileInput = document.getElementById('video_file');
            const videoFileInput_href = document.getElementById('video_file_preview');
            const inputTypeSelect = document.getElementById('inputType');

            // Reset input fields
            youtubeLinkInput.value = '';
            videoFileInput.value = '';

            // Show/hide inputs based on selection
            if (inputTypeSelect.value === 'youtube_link') {
                youtubeLinkInput.classList.remove('d-none');
                videoFileInput.classList.add('d-none');
                videoFileInput_href.classList.add('d-none');
                videoFileInput.value = '';
            } else {
                youtubeLinkInput.classList.add('d-none');
                videoFileInput.classList.remove('d-none');
                videoFileInput_href.classList.remove('d-none');
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const youtubeLinkInput = document.getElementById('youtube_link');
            const videoFileInput = document.getElementById('video_file');
            const videoFileInput_href = document.getElementById('video_file_preview');
            const inputTypeSelect = document.getElementById('inputType');
            // Reset input fields

            // Show/hide inputs based on selection
            if (inputTypeSelect.value === 'youtube_link') {
                youtubeLinkInput.classList.remove('d-none');
                videoFileInput.classList.add('d-none');
                videoFileInput_href.classList.add('d-none');
            } else {
                youtubeLinkInput.classList.add('d-none');
                videoFileInput.classList.remove('d-none');
                videoFileInput_href.classList.remove('d-none');
            }
        });

        
    </script>
@endsection
