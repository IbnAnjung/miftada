@extends('layouts.stisla')

@section('libraries-style')
<link rel="stylesheet" href="{{ asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Rekap Pembayaran</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Pembayaran</a></div>
      <div class="breadcrumb-item"><a href="#">Rekap</a></div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">Rekap Pembayaran</h2>
    <p class="section-lead">ini adalah halaman untuk menampilkan rekapan pembayaran</p>
    <!-- card form rekap pembayaran -->
    <div class="card">
      <div class="card-header">
        <h4>Form Rekap Pembayaran</h4>
        <div class="card-header-action">
          <a data-collapse="#card-rekap-pembayaran" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
        </div>
      </div>
      <div class="collapse show" id="card-rekap-pembayaran">
        <div class="card-body">
          <form action="" class="form mr-auto" id="form-periode">
              <div class="form-group row">
                <label for="range tanggal" class="col-md-2 col-12 control-label">Periode</label>
                <div class="col-md-4 col-6">
                  <input type="text" class="form-control singledatepicker" name="tanggal_awal">
                </div>
                <div class="col-md-4 col-6">
                  <input type="text" class="form-control singledatepicker" name="tanggal_akhir">
                </div>
                <div class="col-md-2 col-12">
                  <button class="btn btn-primary btn-block">Tampilkan</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end card -->

    <!-- card table rekap pembayaran -->
    <div class="card card-primary">
      <div class="card-header with-border">
        <h4>Tabel Rekap Pembayaran</h4>
          <div class="card-header-action">
            <a class="btn btn-icon btn-primary" href="{{ route('tagihan.pembayaran.baru.') }}"><i class="fas fa-plus"></i></a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover" id="table-rekap-pembayaran">
          <thead>
            <tr>
              <td>Tanggal</td>
              <td>Siswa</td>
              <td>Kelas</td>
              <td>Nama Kelas</td>
              <td>Pembayaran</td>
              <td>Total</td>
              <td>Aksi</td>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-6"><h3>Total Pembayaran</h3></div>
          <div class="col-sm-6 text-right"><h3>Rp <span id="total-pembayaran">0</span></h3></div>
        </div>
      </div>
    </div>
    <!-- end card -->
  </div>
</section>
@endsection

<!-- another javascript libraries -->
@section('libraries-script')
<script src="{{ asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('stisla/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/pages/bayarTagihan.js') }}"></script>
@endsection

<!-- page script -->
@section('script')

</script>
@endsection