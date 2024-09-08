@extends('landing.layouts.index')

@section('content')
    <!-- Jumbotron -->
    <section class=" d-table w-100 bg-half-260"
        style="background: url('{{ asset('images/image-header/' . $slider->gambar) }}'); height: 75vh; background-repeat: no-repeat; background-size: cover; background-position: center;">
        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Reindo Syariah</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('layanan.pengaduan.heading')</li>
                </ul>
            </nav>
        </div>
    </section>

    <div class="position-relative">
        <div class="shape overflow-hidden text-color-white">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <section class="section ">
        <div class="container">
            <div class="row mb-2">
                <form id="form-pengaduan" class="form" action="{{ route('pengaduan.store') }}" autocomplete="off"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.pengaduan.nama_perusahaan')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="nama_perusahaan" id="nama_perusahaan"
                                    placeholder="@lang('layanan.pengaduan.nama_perusahaan_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.pengaduan.nama_pic')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="nama_pic" id="nama_pic"
                                    placeholder="@lang('layanan.pengaduan.nama_pic_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.pengaduan.alamat')</span></strong>
                                </label>
                                <textarea class="form-control " name="alamat_perusahaan" id="alamat_perusahaan" placeholder="@lang('layanan.pengaduan.alamat_placeholder')"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.pengaduan.no_tlp_perusahaan')</span></strong>
                                </label>
                                <input type="number" class="form-control " name="no_tlp_perusahaan" id="no_tlp_perusahaan"
                                    placeholder="@lang('layanan.pengaduan.no_tlp_perusahaan_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.pengaduan.no_hp_pic')</span></strong>
                                </label>
                                <input type="number" class="form-control " name="no_hp_pic" id="no_hp_pic"
                                    placeholder="@lang('layanan.pengaduan.no_hp_pic_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.pengaduan.email')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="email" id="email"
                                    placeholder="@lang('layanan.pengaduan.email_placeholder')">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center mb-2">
                                    <strong><span class="required">@lang('layanan.pengaduan.jenis_layanan')</span></strong>
                                </label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="jenis_layanan"
                                        id="jenis_layanan_jiwa" value="Reasuransi Jiwa" onclick="toggleInput();">
                                    <label for="jenis_layanan_jiwa">@lang('layanan.pengaduan.jiwa')</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="jenis_layanan"
                                        id="jenis_layanan_umum" value="Reasuransi Umum" onclick="toggleInput();">
                                    <label for="jenis_layanan_umum">@lang('layanan.pengaduan.umum')</label>
                                </div>
                                <div class="form-check d-flex align-items-center">
                                    <input type="radio" class="form-check-input my-0" name="jenis_layanan"
                                        id="jenis_layanan_lainnya" value="Lainnya" onclick="toggleInput();">
                                    <label class=" me-2 ms-2 my-0" for="jenis_layanan_lainnya">@lang('layanan.pengaduan.lainnya')</label>
                                    <input type="text" class="form-control" name="jenis_layanan_lainnya_text"
                                        id="jenis_layanan_lainnya_text" placeholder="@lang('layanan.pengaduan.lainnya')" disabled>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.pengaduan.kategori')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="kategori" id="kategori"
                                    placeholder="@lang('layanan.pengaduan.kategori_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.pengaduan.uraian')</span></strong>
                                </label>
                                <textarea class="form-control " name="uraian" id="uraian" placeholder="@lang('layanan.pengaduan.uraian_placeholder')"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.pengaduan.lampiran')</span></strong>
                                </label>
                                <input type="file" class="form-control " name="lampiran" id="lampiran">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="reset" class="btn btn-warning me-2" id="resetButton">Reset</button>
                        <button type="submit" class="btn btn-success" id="submit_pengaduan">@lang('layanan.pengaduan.kirim')</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function() {
            document.getElementById('jenis_layanan_lainnya_text').disabled = true;
            validasi();
        });

        // validasi inputan kosong
        function validasi() {
            const form = document.getElementById('form-pengaduan');
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'nama_perusahaan': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.pengaduan.V_nama_perusahaan')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.pengaduan.V_input255')'
                                }
                            }
                        },
                        'nama_pic': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.pengaduan.V_nama_pic')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.pengaduan.V_input255')'
                                }
                            }
                        },
                        'alamat_perusahaan': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.pengaduan.V_alamat')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.pengaduan.V_input255')'
                                }
                            }
                        },
                        'no_tlp_perusahaan': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.pengaduan.V_no_tlp_perusahaan')'
                                },
                                stringLength: {
                                    max: 15,
                                    message: '@lang('layanan.pengaduan.V_input15').'
                                }
                            }
                        },
                        'no_hp_pic': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.pengaduan.V_no_hp_pic')'
                                },
                                stringLength: {
                                    max: 15,
                                    message: '@lang('layanan.pengaduan.V_input15').'
                                }
                            }
                        },
                        'email': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.pengaduan.V_email')'
                                },
                                emailAddress: {
                                    message: '@lang('layanan.pengaduan.V_email_format')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.pengaduan.V_input255')'
                                }
                            }
                        },
                        'jenis_layanan': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.pengaduan.V_jenis_layanan')'
                                },
                            }
                        },
                        'kategori': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.pengaduan.V_kategori')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.pengaduan.V_input255')'
                                }
                            }
                        },
                        'uraian': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.pengaduan.V_uraian')'
                                },
                                // stringLength: {
                                //     max: 255,
                                //     message: '@lang('layanan.pengaduan.V_input255')'
                                // }
                            }
                        },
                        'lampiran': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.pengaduan.V_lampiran')'
                                },
                                file: {
                                    extension: 'jpg,jpeg,png,gif,pdf,doc,docx,txt',
                                    type: 'image/jpeg,image/png,image/gif,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain',
                                    maxSize: 10485760, // 10 * 1024 * 1024
                                    message: '@lang('layanan.pengaduan.V_max')',
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
            const submitButton = document.getElementById('submit_pengaduan');
            submitButton.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        if (status == 'Valid') {
                            // block_ui();
                            // swall alert
                            Swal.fire({
                                title: 'Send this complaint?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'Cancel',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit(); // Submit form
                                    // swall alert success
                                    Swal.fire(
                                        'Success',
                                    )
                                }
                            });
                            // form.submit(); // Submit form
                        }
                    });
                }
            });
        }

        function toggleInput() {
            var inputField = document.getElementById("jenis_layanan_lainnya_text");
            var option1 = document.getElementById("jenis_layanan_jiwa");
            var option2 = document.getElementById("jenis_layanan_umum");
            var option3 = document.getElementById("jenis_layanan_lainnya");

            if (option3.checked) {
                inputField.disabled = false;
            } else {
                inputField.disabled = true;
                inputField.value = ""; // Mengosongkan value saat disabled
            }
        }

        document.getElementById('resetButton').addEventListener('click', function() {
            document.getElementById('form-pengaduan').reset();
            const form = document.getElementById('form-pengaduan');
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
            });
            document.getElementById('jenis_layanan_lainnya_text').disabled =
            true; // Disable the text input after reset
        });
    </script>
@endsection
