@extends('cms.layout.index')
@section('judul', 'Manajemen Image Header')
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card card-flush">     
            <div class="card-header mt-6">        
                <div class="card-title">           
                    <div class="d-flex align-items-center position-relative my-1 me-5">            
                        <p style="font-family: Maven Pro, sans-serif; font-size: 16px; font-weight: 600;">Data Header Images</p>
                    </div>        
                </div>
            </div>
             
            <div class="card-body pt-0">     
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="tbl-header">
                    <thead>
                        <tr class="text-start text-black-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="fixed-w-50px">No</th>
                            <th class="fixed-w-150px">Gambar</th>
                            <th class="fixed-w-300px">Halaman</th>
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
<!-- solusi -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content">
            <div class="modal-header">
                <h2></h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body py-lg-10 px-lg-10">
                <div class="card-body pb-0 pt-1">
                    <div id="response-edit"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // GET DATA
    $(function() {
        $("#tbl-header").DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('manajemen-image-header.getDataJson') }}",
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
                    data: 'kategori',
                    name: 'kategori',
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
                { "width": "25%", "targets": 1 },
                { "width": "30%", "targets": 2 },
                { "width": "30%", "targets": 3 },
            ]
        });
    });

    // EDIT DATA BUTTON
    function btn_edit(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('manajemen-image-header.edit', '') }}" + '/' + id,
            success: function(response) {
                $('#response-edit').html(response);
                $('#modal-edit').modal('show');
            }
        });
    }
</script>
@endsection