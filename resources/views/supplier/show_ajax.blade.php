@empty($supplier)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/supplier') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-info-circle"></i> Detail Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th class="text-right col-3"><i class="fas fa-barcode"></i> Kode Supplier :</th>
                        <td class="col-9">{{ $supplier->supplier_kode }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3"><i class="fas fa-user"></i> Nama Supplier :</th>
                        <td class="col-9">{{ $supplier->supplier_nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3"><i class="fas fa-map-marker-alt"></i> Alamat Supplier :</th>
                        <td class="col-9">{{ $supplier->supplier_alamat }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning"><i class="fas fa-times-circle"></i>
                    Tutup</button>
            </div>
        </div>
    </div>
@endempty