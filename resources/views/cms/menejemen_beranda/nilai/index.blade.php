@extends('cms.layout.index')
@section('judul', 'Nilai')
@section('sub-judul', 'Manajemen Beranda')
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        
        <div class="row gy-5 g-xl-10">         
            <div class="col-xl-12 mb-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pb-0 pt-10 d-flex justify-content-between align-items-center">
                        <h3 class="card-title align-items-start flex-column">
                            Pilih yang akan ditampilkan di Beranda depan :
                        </h3>
                    </div>
                    <div class="card-body pb-0 pt-4">
                        <div class="row">
                            <div class="col-12"> 
                                <div class="col-md-12">
                                    <select class="form-select mb-4" data-control="select2" data-hide-search="true" data-placeholder="Pilih" name="status_nilai" id="status_nilai">
                                        <option></option>
                                        <option value="1" @if ($status_nilai->status_nilai == 1) selected="" @endif>Versi 1 (Gambar)</option>
                                        <option value="2" @if ($status_nilai->status_nilai == 2) selected="" @endif>Versi 2 (Text)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="row gy-5 g-xl-10">         
            <div class="col-xl-12 mb-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pb-0 pt-10 d-flex justify-content-between align-items-center">
                        <h3 class="card-title align-items-start flex-column">
                        </h3>
                        <div class="ms-auto ">
                            <button id="edit_ucapan" class="btn btn-sm btn-warning" onclick="edit()">
                                <span class="indicator-label">Edit</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body pb-0 pt-4">
                        <form id="form-edit-nilai-gambar" class="form" action="{{ route('manajemen-nilai.update_gambar', $data_by_gambar->id) }}" autocomplete="off" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12"> 
                                    <div class="col-md-12">
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span >File Gambar</span>
                                        </label>
                                        <input type="file" class="form-control mb-4 mr-4" name="gambar" id="gambar" onchange="previewImage(event)" value="{{$data_by_gambar->gambar}}" disabled >
                                    </div>
                                    <img src="{{ asset('images/nilai_by_gambar/' . $data_by_gambar->gambar) }}" style="max-height: 150px; " id="image-preview-img" onerror="this.style.display='none'">
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end m-4">
                                <button id="submit_edit_nilai_gambar" class="btn btn-primary" style="display: none;">
                                    <span class="indicator-label">Simpan</span>
                                </button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div> 

        <div class="card card-flush">     
            <div class="card-header mt-6">        
                <div class="card-title">           
                    <div class="d-flex align-items-center position-relative my-1 me-5">            
                        <p style="font-family: Maven Pro, sans-serif; font-size: 16px; font-weight: 600;">Data Nilai</p>
                    </div>        
                </div>
                <div class="card-toolbar"> 
                    <button type="button" class="btn btn-light-success btn-tambah-nilai">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        Tambah Data
                    </button>
                </div>
            </div>             
            <div class="card-body pt-0">     
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="tbl-nilai">
                    <thead>
                        <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="fixed-w-50px">No</th>
                            <th class="fixed-w-100px">gambar</th>
                            <th class="fixed-w-150px">Text</th>
                            <th class="fixed-w-350px">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                    </tbody>              
                </table>          
            </div>      
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    validasi();

    // GET DATA
    $(function() {
        $("#tbl-nilai").DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('manajemen-nilai.getDataJson') }}",
                type: "POST",
            },
            "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",
            language: {
                emptyTable: "Tidak ada data yang tersedia",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                lengthMenu: "Tampilkan _MENU_ data",
                loadingRecords: "Memuat...",
                processing: "Sedang memproses...",
                search: "Cari:",
                zeroRecords: "Tidak ditemukan data yang sesuai",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya",
                },
                aria: {
                    sortAscending: ": aktifkan untuk mengurutkan kolom secara ascending",
                    sortDescending: ": aktifkan untuk mengurutkan kolom secara descending",
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'gambar',
                    name: 'gambar',
                },
                {
                    data: 'text',
                    name: 'text',
                },
                {
                    data: 'opsi',
                    name: 'opsi',
                    searchable: false,
                    searchable: false
                },
            ],
            "columnDefs": [
                {
                    "targets": '_all',
                    "defaultContent": "-",
                    "className": "text-center"
                },                                
                { "width": "5%", "targets": 0 },
                { "width": "30%", "targets": 1 },
                { "width": "35%", "targets": 2 },
                { "width": "30%", "targets": 3 },
            ]
        });

        
        $('#status_nilai').on('change', function() {
            var selectedValue = $(this).val();

            $.ajax({
                url: "{{ route('update_nilai_status') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status_nilai: selectedValue,
                },
                error: function(xhr) {
                    console.log('Error updating status');
                }
            });
        });
    });

    // ADD DATA BUTTOn
    $('.btn-tambah-nilai').on('click', function() {        
        window.location.href = "{{ route('manajemen-nilai.create') }}";
    });

    // EDIT DATA BUTTON
    function btn_edit_nilai(id) {
        window.location.href = "{{ route('manajemen-nilai.edit', '') }}" + '/' + id;
    }
    // DELETE DATA BUTTON
    function btn_hapus_nilai(id) {
        Swal.fire({
            title: 'Hapus Data',
            text: "Apakah Anda yakin akan menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "{{ route('manajemen-nilai.destroy', '') }}" + '/' + id;
            }
        });
    }

    // validasi inputan kosong
    function validasi() {
        const form = document.getElementById('form-edit-nilai-gambar');

        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'gambar': {
                        validators: {         
                            file: {
                                extension: 'jpeg,jpg,png,gif', // Allowed image file extensions
                                type: 'image/jpeg,image/png,image/gif', // Allowed MIME types
                                maxSize: 2097152, // 2048 * 1024 (2MB)
                                message: 'Hanya bisa upload file gambar (jpeg, jpg, png, gif) dengan ukuran maksimal 2MB.',
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

        const submitButton = document.getElementById('submit_edit_nilai_gambar');
        submitButton.addEventListener('click', function(e) {
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

    function edit() {
        document.getElementById('gambar').disabled = false;
        document.getElementById('edit_ucapan').style.display = 'none';
        document.getElementById('submit_edit_nilai_gambar').style.display = 'inline-block';
    }

</script>
@endsection