@extends('cms.layout.index')
@section('css')
<style>
    /* Custom styles for smaller screens */
    @media (max-width: 767.98px) {
        .custom-button {
            width: 100%; /* Full width on smaller screens */
        }
    }
</style>
@endsection
@section('judul', 'Struktur Organisasi')
@section('sub-judul', 'Manajemen Tentang Kami')
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
    
        <div class="row gy-5 g-xl-10">
            <div class="col-xl-12">		
                <div class="card card-flush"> 
                    <div class="card-body">
                        <div class="col-12 row">
                            <div class="col-md-6">                                   
                                <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">
                                    <span class="svg-icon svg-icon-warning me-5">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor" />
                                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <div class="flex-grow-1 me-2">
                                        <p class="fw-bolder text-gray-800 text-hover-primary fs-6">Upload Bagan Struktur Organisasi</p>
                                    </div>
                                    <button class="btn btn-icon btn-light-danger btn-sm me-3" onclick="btn_bagan()"><i class="bi bi-pencil fs-4"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6">                                    
                                <!-- <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">
                                    <span class="svg-icon svg-icon-warning me-5">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor" />
                                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                    <div class="flex-grow-1 me-2">
                                        <p class="fw-bolder text-gray-800 text-hover-primary fs-6">Manajemen Data Master Jabatan</p>
                                    </div>
                                    <a href="{{ route('master-jabatan') }}" class="btn btn-icon btn-light-danger btn-sm me-3"><i class="bi bi-pencil fs-4"></i></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 mb-xl-10">
                <div class="card card-flush">
                    <div class="card-header mt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 me-5">
                                <p style="font-family: Maven Pro, sans-serif; font-size: 16px; font-weight: 600;">Data Manajemen ReIndo Syariah & Kepala Divisi</p>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-light-success btn-tambah-jajaran">
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
                    <div>
                        <!-- <form action="{{ route('struktur_organisasi.uploadImage') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                            @csrf
                            <label for="formFile" class="form-label">Upload Gambar Struktur Organisasi</label>
                            <div class="mt-3">
                                <div class="d-flex flex-column flex-sm-row align-items-center">
                                    <input class="form-control mb-2 mb-sm-0" type="file" id="formFile" name="organization_structure_image" placeholder="Maksimal Ukuran File : 10MB">
                                    <button type="submit" class="btn btn-secondary p-0">Upload Image</button>
                                </div>
                            </div>
                            <label for="formFile" class="form-label"><span style="color:red">*</span> Maksimal ukuran file 10MB</label> 
                        </form>-->
                        <!-- <img id="imagePreview" alt="Preview gambar yang akan diupload" class="img-fluid rounded-md shadow-lg mb-5" style="z-index: 0;"> -->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="tbl-jajaran">
                            <thead>
                                <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="fixed-w-50px">No</th>
                                    <th class="fixed-w-200px">Gambar</th>
                                    <th class="fixed-w-150px">Nama</th>
                                    <th class="fixed-w-250px">Jabatan</th>
                                    <th class="fixed-w-150px">tagline</th>
                                    <th class="fixed-w-250px">Deskripsi</th>
                                    <th class="fixed-w-150px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-bold text-gray-600">
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-bagan" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>Ubah Data</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body py-lg-10 px-lg-10">
                <div class="card-body pb-0 pt-0">
                    <form action="{{ route('struktur_organisasi.uploadImage') }}" method="POST" enctype="multipart/form-data" class="mt-0">
                        @csrf
                        <h4 for="formFile">Upload Bagan Struktur Organisasi</h4>
                        <label for="formFile" class="form-label text-muted"><span style="color:red">*</span>Hanya bisa upload file gambar (jpeg, jpg, png, gif) dengan ukuran maksimal 10MB.</label> 
                        <div class="mt-0">
                            <div class="d-flex flex-column flex-sm-row align-items-center">
                                <input class="form-control mb-2 mb-sm-0" type="file" id="formFile" name="organization_structure_image" placeholder="Maksimal Ukuran File : 10MB" onchange="previewbagan(event)">
                                <button id="submit_bagan" type="submit" class="btn btn-primary ms-2">
                                    <span class="indicator-label">Simpan</span>
                                </button>
                            </div>
                            <img src="" alt="" style="max-height: 300px; display: none;" id="image-preview-img-bagan">
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
@endsection

@section('js')
<script>
    // GET DATA
    $(function() {
        $("#tbl-jajaran").DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('struktur_organisasi.getDataJson') }}",
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
                    data: 'nama',
                    name: 'nama',
                },
                {
                    data: 'jabatan',
                    name: 'jabatan',
                },
                {
                    data: 'tagline',
                    name: 'tagline',
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi',
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
            ]
        });
    });

    // ADD DATA MODAL
    $('.btn-tambah-jajaran').on('click', function() {
        window.location.href = "{{ route('struktur_organisasi.create') }}";
    });

    // EDIT DATA BUTTON
    function btn_edit_jajaran(id) {
        window.location.href = "{{ route('struktur_organisasi.edit', '') }}" + '/' + id;
    }
    // DELETE DATA BUTTON
    function btn_hapus_jajaran(id) {
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
                window.location = "{{ route('struktur_organisasi.destroy', '') }}" + '/' + id;
            }
        });
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                preview.src = '';
            }
        }
    }
    $('#formFile').on("change",(event) => {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            preview.src = '';
        }
    });
    function btn_bagan(id) {
        $('#modal-edit-bagan').modal('show');
    }

    // preview gambar
    function previewbagan(event) {
        var image = document.getElementById('image-preview-img-bagan');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.display = 'block';
    }
</script>
@endsection
