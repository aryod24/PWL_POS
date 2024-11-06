@extends('layouts.template')

@section('content')
<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cogs"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Kategori</span>
                <span class="info-box-number">8</span>
                <small class="text-muted">Dari 20 produk</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Penjualan</span>
                <span class="info-box-number">Rp 1.250.000</span>
                <small class="text-muted">Total pendapatan saat ini</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chart-line"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pertumbuhan Bulanan</span>
                <span class="info-box-number">15%</span>
                <small class="text-success">Dibandingkan bulan lalu</small>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation-triangle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Produk Habis</span>
                <span class="info-box-number">3</span>
                <small class="text-muted">Segera restock</small>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Produk -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Daftar Barang</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table_produk">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color: #f9f9f9;">
                                <td><img src="{{ asset('img/laptop1.jpg') }}" alt="Buku Tulis" style="width: 200px; height: 200px; object-fit: cover;"></td>
                                <td>LP01</td>
                                <td>Laptop Gaming</td>
                                
                                <td>Elektronik</td>
                                <td>Rp 13.000.000</td>
                                <td>Rp 15.000.000</td>
                                <td>4</td>
                            </tr>
                            <tr style="background-color: #fff;">
                                <td><img src="{{ asset('img/laptop2.jpg') }}" alt="Pena" style="width: 200px; height: 200px; object-fit: cover;"></td>
                                <td>LP02</td>
                                <td>Laptop Gaming</td>
                                <td>Elektronik</td>
                                <td>Rp 13.000.000</td>
                                <td>Rp 15.000.000</td>
                                <td>4</td>
                            </tr>
                            <tr style="background-color: #f9f9f9;">
                                <td><img src="{{ asset('img/laptop5.jpg') }}" alt="Tas Ransel" style="width: 200px; height: 200px; object-fit: cover;"></td>
                                <td>LP03</td>
                                <td>Laptop Gaming</td>
                                <td>Elektronik</td>
                                <td>Rp 13.000.000</td>
                                <td>Rp 15.000.000</td>
                                <td>4</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 

@endsection

@push('css')
<style>
.info-box {
    transition: transform 0.3s;
}
.info-box:hover {
    transform: translateY(-5px);
}
.badge {
    font-size: 0.875rem;
}

/* CSS untuk tabel */
.table th, .table td {
    text-align: center;
    vertical-align: middle;
}

.table {
    background-color: #f9f9f9;
    border: 1px solid #dee2e6; /* Border tabel */
}

.card-header {
    background-color: #007bff;
    color: white;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f2f2f2; /* Warna latar belakang untuk baris ganjil */
}

.table-striped tbody tr:hover {
    background-color: #e9ecef; /* Warna latar belakang saat hover */
}

.table img {
    border-radius: 5px; /* Border radius untuk gambar */
}
</style>
@endpush

@push('js')
<!-- Chart.js script removed -->
@endpush
