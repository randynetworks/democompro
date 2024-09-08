@extends('cms.layout.index')
@section('judul', 'Jadwal Acara')
@section('sub-judul', 'Manajemen Beranda - Kegiatan')
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card card-flush">     
            <div class="card-header mt-6">        
                <div class="card-title">           
                    <div class="d-flex align-items-center position-relative my-1 me-5">            
                        <p style="font-family: Maven Pro, sans-serif; font-size: 16px; font-weight: 600;">Data Jadwal Acara</p>
                        <div class="d-flex align-items-center ms-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status_calendar" name="status_calendar">
                            </div>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Switch ini untuk mengatur apakah calendar ini perlu ditampilkan pada halaman Perusahaan Kami atau tidak."></i>
                        </div>
                    </div>        
                </div>
                <div class="card-toolbar"> 
                    <button type="button" class="btn btn-light-success btn-add-jadwal">
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
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="tbl-jadwal">
                    <thead>
                        <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="fixed-w-50px">No</th>
                            <th class="fixed-w-150px">Headline</th>
                            <th class="fixed-w-300px">Deskripsi</th>
                            <th class="fixed-w-250px">Waktu Mulai</th>
                            <th class="fixed-w-250px">Waktu Selesai</th>
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
@endsection

@section('js')
<script>
    // GET DATA
    $(function() {
        $("#tbl-jadwal").DataTable({
            processing: true,
            serverSide: false, 
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('jadwal.getDataJson') }}",
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
                    data: 'headline',
                    name: 'headline',
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi',
                },
                {
                    data: 'start_date',
                    name: 'start_date',
                },
                {
                    data: 'end_date',
                    name: 'end_date',
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
    $('.btn-add-jadwal').on('click', function() {        
        window.location.href = "{{ route('jadwal.create') }}";
    });

    // EDIT DATA BUTTON
    function btn_edit_jadwal(id) {
        window.location.href = "{{ route('jadwal.edit', '') }}" + '/' + id;
    }
    // DELETE DATA BUTTON
    function btn_hapus_jadwal(id) {
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
                window.location = "{{ route('jadwal.destroy', '') }}" + '/' + id;
            }
        });
    }

    $('#status_calendar').change(function() {
        var status = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{ route('update_nilai_calendar') }}",  // Ganti dengan URL endpoint server Anda
            type: 'POST',
            data: {
                status_calendar: status,
                _token: '{{ csrf_token() }}' // Jika menggunakan Laravel, pastikan Anda menyertakan token CSRF
            },
            success: function(response) {
                
            },
            error: function(xhr, status, error) {
                
            }
        });
    });
</script>
@endsection