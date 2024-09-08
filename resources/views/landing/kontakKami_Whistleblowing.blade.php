@extends('landing.layouts.index')

@section('content')
    <!-- Jumbotron -->
    <section class=" d-table w-100 bg-half-260"
        style="background: url('{{ asset('images/image-header/' . $slider->gambar) }}'); height: 75vh; background-repeat: no-repeat; background-size: cover; background-position: center;">

        <div class="position-breadcrumb">
            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb rounded shadow mb-0 px-4 py-2">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Reindo Syariah</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('layanan.whistleblowing.heading')</li>
                </ul>
            </nav>
        </div>
        </div> <!--end container-->
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
                <form id="form-Whistleblowing" class="form" action="{{ route('whistleblowing.store') }}"
                    autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.whistleblowing.nama_pelapor')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="nama_pelapor" id="nama_pelapor"
                                    placeholder="@lang('layanan.whistleblowing.nama_pelapor_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.whistleblowing.no_tlp_pelapor')</span></strong>
                                </label>
                                <input type="number" class="form-control " name="no_tlp_pelapor" id="no_tlp_pelapor"
                                    placeholder="@lang('layanan.whistleblowing.no_tlp_pelapor_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.whistleblowing.email_pelapor')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="email_pelapor" id="email_pelapor"
                                    placeholder="@lang('layanan.whistleblowing.email_pelapor')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center mb-2">
                                    <strong><span class="required">@lang('layanan.whistleblowing.tindakan')</span></strong>
                                </label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="tindakan_yang_dilaporkan"
                                        id="tindakan_yang_dilaporkan_fraud" value="Fraud" onclick="toggleInput()">
                                    <label for="tindakan_yang_dilaporkan_fraud">@lang('layanan.whistleblowing.fraud')</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="tindakan_yang_dilaporkan"
                                        id="tindakan_yang_dilaporkan_kode_etik" value="Pelanggaran Kode Etik" onclick="toggleInput()">
                                    <label for="tindakan_yang_dilaporkan_kode_etik">@lang('layanan.whistleblowing.kode_etik')</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="tindakan_yang_dilaporkan"
                                        id="tindakan_yang_dilaporkan_benturan" value="Pelanggaran Benturan Kode Etik" onclick="toggleInput()">
                                    <label for="tindakan_yang_dilaporkan_benturan">@lang('layanan.whistleblowing.benturan')</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="tindakan_yang_dilaporkan"
                                        id="tindakan_yang_dilaporkan_hukum" value="Pelanggaran Hukum" onclick="toggleInput()">
                                    <label for="tindakan_yang_dilaporkan_hukum">@lang('layanan.whistleblowing.hukum')</label>
                                </div>
                                <div class="form-check d-flex align-items-center">
                                    <input type="radio" class="form-check-input my-0" name="tindakan_yang_dilaporkan"
                                        id="tindakan_yang_dilaporkan_lainnya" value="Lainnya" onclick="toggleInput()">
                                    <label class=" me-2 ms-2 my-0"
                                        for="tindakan_yang_dilaporkan_lainnya">@lang('layanan.whistleblowing.lainnya')</label>
                                    <input type="text" class="form-control"
                                        name="tindakan_yang_dilaporkan_lainnya_text"
                                        id="tindakan_yang_dilaporkan_lainnya_text" placeholder="@lang('layanan.whistleblowing.lainnya')"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.whistleblowing.lampiran')</span></strong>
                                </label>
                                <input type="file" class="form-control " name="lampiran" id="lampiran">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.whistleblowing.nama_terlapor')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="nama_terlapor" id="nama_terlapor"
                                    placeholder="@lang('layanan.whistleblowing.nama_terlapor_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.whistleblowing.jabatan_terlapor')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="jabatan_terlapor"
                                    id="jabatan_terlapor" placeholder="@lang('layanan.whistleblowing.jabatan_terlapor_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.whistleblowing.waktu')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="waktu" id="waktu"
                                    placeholder="@lang('layanan.whistleblowing.waktu_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.whistleblowing.lokasi')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="lokasi" id="lokasi"
                                    placeholder="@lang('layanan.whistleblowing.lokasi_placeholder')">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.whistleblowing.kronologis')</span></strong>
                                </label>
                                <textarea class="form-control " name="kronologis" id="kronologis" placeholder="@lang('layanan.whistleblowing.kronologis_placeholder')"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center">
                                    <strong><span class="required">@lang('layanan.whistleblowing.nominal')</span></strong>
                                </label>
                                <input type="text" class="form-control " name="nominal" id="nominal"
                                    placeholder="@lang('layanan.whistleblowing.nominal_placeholder')">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="reset" class="btn btn-warning me-2" id="resetButton">Reset</button>
                        <button type="submit" class="btn btn-success"
                            id="submit_Whistleblowing">@lang('layanan.whistleblowing.kirim')</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function() {
            document.getElementById('tindakan_yang_dilaporkan_lainnya_text').disabled = true;
            validasi();
        });

        // validasi inputan kosong
        function validasi() {
            const form = document.getElementById('form-Whistleblowing');
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'nama_pelapor': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_nama_pelapor')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.whistleblowing.V_input255')'
                                }
                            }
                        },
                        'no_tlp_pelapor': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_no_tlp_pelapor')'
                                },
                                stringLength: {
                                    max: 15,
                                    message: '@lang('layanan.whistleblowing.V_input15')'
                                }
                            }
                        },
                        'email_pelapor': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_email')'
                                },
                                emailAddress: {
                                    message: '@lang('layanan.whistleblowing.V_email_format')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.whistleblowing.V_input255')'
                                }
                            }
                        },
                        'tindakan_yang_dilaporkan': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_tindakan')'
                                },
                            }
                        },
                        'lampiran': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_lampiran')'
                                },
                                file: {
                                    extension: 'jpg,jpeg,png,gif,pdf,doc,docx,txt',
                                    type: 'image/jpeg,image/png,image/gif,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain',
                                    maxSize: 10485760, // 10 * 1024 * 1024
                                    message: '@lang('layanan.whistleblowing.V_max')',
                                },
                            }
                        },
                        'nama_terlapor': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_nama_terlapor')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.whistleblowing.V_input255')'
                                }
                            }
                        },
                        'jabatan_terlapor': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_jabatan_terlapor')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.whistleblowing.V_input255')'
                                }
                            }
                        },
                        'waktu': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_waktu')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.whistleblowing.V_input255')'
                                }
                            }
                        },
                        'lokasi': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_lokasi')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.whistleblowing.V_input255')'
                                }
                            }
                        },
                        'kronologis': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_kronologi')'
                                },
                            }
                        },
                        'nominal': {
                            validators: {
                                notEmpty: {
                                    message: '@lang('layanan.whistleblowing.V_nominal')'
                                },
                                stringLength: {
                                    max: 255,
                                    message: '@lang('layanan.whistleblowing.V_input255')'
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
            const submitButton = document.getElementById('submit_Whistleblowing');
            submitButton.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {

                        if (status == 'Valid') {
                            // block_ui();
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
            });
        }

        // document.getElementById('tindakan_yang_dilaporkan_lainnya').addEventListener('change', function() {
        //     document.getElementById('tindakan_yang_dilaporkan_lainnya_text').disabled = !this.checked;
        // });

        function toggleInput() {
            var inputField = document.getElementById("tindakan_yang_dilaporkan_lainnya_text");
            var option1 = document.getElementById("tindakan_yang_dilaporkan_fraud");
            var option2 = document.getElementById("tindakan_yang_dilaporkan_kode_etik");
            var option3 = document.getElementById("tindakan_yang_dilaporkan_benturan");
            var option4 = document.getElementById("tindakan_yang_dilaporkan_hukum");
            var option5 = document.getElementById("tindakan_yang_dilaporkan_lainnya");

            if (option5.checked) {
                inputField.disabled = false;
            } else {
                inputField.disabled = true;
                inputField.value = ""; // Mengosongkan value saat disabled
            }
        }

        document.getElementById('resetButton').addEventListener('click', function() {
            document.getElementById('form-Whistleblowing').reset();
            const form = document.getElementById('form-Whistleblowing');
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
            });
            document.getElementById('tindakan_yang_dilaporkan_lainnya_text').disabled = true; // Disable the text input after reset
        });
    </script>
@endsection
