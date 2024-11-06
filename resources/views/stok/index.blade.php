@extends('layouts.template')

@section('content')
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/stok/import') }}')" class="btn btn-sm btn-info mt-1">Import
                    Stok</button>
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('/stok/export_excel') }}"><i
                        class="fa fa-file-excel"></i> Export Stok</a>
                <a class="btn btn-sm btn-warning mt-1" href="{{ url('/stok/export_pdf') }}"><i class="fa fa-file-pdf"></i>
                    Export Stok</a>
                <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah
                    Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="user_id" name="user_id">
                                <option value="">- Semua User -</option>
                                @foreach ($user as $u)
                                    <option value="{{ $u->user_id }}">{{ $u->nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">User</small>
                        </div>
                        <div class="col-3">
                            <select class="form-control" id="barang_id" name="barang_id">
                                <option value="">- Semua Barang -</option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Barang</small>
                        </div>
                        <div class="col-3">
                            <select class="form-control" id="supplier_id" name="supplier_id">
                                <option value="">- Semua Supplier -</option>
                                @foreach ($supplier as $s)
                                    <option value="{{ $s->supplier_id }}">{{ $s->supplier_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Supplier</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Supplier ID</th>
                            <th>Barang ID</th>
                            <th>User ID</th>
                            <th>Stok Tanggal</th>
                            <th>Stok Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        /* Styling untuk tabel */
        #table_stok {
            border: 1px solid #007bff; /* Border tabel */
            border-radius: 0.5rem; /* Sudut tabel membulat */
            overflow: hidden; /* Menghindari border radius di luar tabel */
        }

        #table_stok thead {
            background-color: #007bff; /* Warna latar belakang header */
            color: white; /* Warna teks header */
        }

        #table_stok th, #table_stok td {
            padding: 10px; /* Jarak dalam sel */
            text-align: center; /* Rata tengah */
        }

        #table_stok tbody tr {
            transition: background-color 0.3s; /* Animasi saat hover */
        }

        #table_stok tbody tr:hover {
            background-color: #f0f8ff; /* Warna latar belakang saat hover */
        }

        /* Styling untuk kolom yang berisi aksi */
        #table_stok td:last-child {
            background-color: #e9ecef; /* Warna latar belakang untuk kolom aksi */
        }
    </style>
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
        $(document).ready(function() {
            dataStok = $('#table_stok').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('stok/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.supplier_id = $('#supplier_id').val();
                        d.barang_id = $('#barang_id').val();
                        d.user_id = $('#user_id').val();
                    }
                },
                columns: [{
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "supplier.supplier_id",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "barang.barang_id",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "user.user_id",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "stok_tanggal",
                    className: "",
                    orderable: true,
                    searchable: false
                }, {
                    data: "stok_jumlah",
                    className: "",
                    orderable: true,
                    searchable: false
                }, {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });

            // Reload dataStok when filter changes
            $('#supplier_id, #barang_id, #user_id').on('change', function() {
                dataStok.ajax.reload();
            });
        });
    </script>
@endpush
