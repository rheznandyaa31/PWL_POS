@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ url('kategori/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
                <button onclick="modalAction('{{ url('/kategori/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('errror') }}
                </div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>kategori kode</th>
                        <th>kategori Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
        
        var dataKategori;
        $(document).ready(function() {
            var dataKategori = $('#table_kategori').DataTable({
            dataKategori = $('#table_kategori').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax: {
                    "url": "{{ url('kategori/list') }}",
                    "dataType" : "json",
                    "type": "POST",
                },
                columns: [
                    {
                        // nomor urut dari laravel datatable addIndexColumn()
                        data: "DT_RowIndex",
                        ClassName: "text-center",
                        orderable: false,
                        searchable: false
                    },{
                        data: "kategori_kode",
                        ClassName: "",
                        // orderable: true, jika ingin kolom ini bisa diurutkan
                        orderable: true,
                        // searchable: true, jika ingin kolom ini bisa dicari
                        searchable: true
                    },{
                        // mengambil data kategori hasil dari ORM berelasi
                        data: "kategori_nama",
                        ClassName: "",
                        orderable: true,
                        searchable: true
                    },{
                        data: "aksi",
                        ClassName: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>