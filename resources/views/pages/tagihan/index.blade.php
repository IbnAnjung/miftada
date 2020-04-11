@extends('layouts.stisla')

@section('libraries-style')
<link rel="stylesheet" href="{{ asset('stisla/modules/prism/prism.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/izitoast/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Tagihan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Tagihan</a></div>
    </div>
  </div>

  <div class="section-body">
    <div class="section-title">Daftar Tagihan</div>
    <div class="card">
      <div class="card-header">
        <h4>Daftar Tagihan</h4>
        <div class="card-header-action">
        
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover" id="table-tagihan">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Terbit</th>
              <th>Nominal</th>
              <th>Total Tagihan</th>
              <th>Terbayar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div class="card-footer bg-whitesmoke">
        
      </div>
    </div>
  </div>
</section>

@include('pages.siswa.form-tambah-status-siswa')
@endsection

<!-- another javascript libraries -->
@section('libraries-script')
<script src="{{ asset('stisla/modules/prism/prism.js') }}"></script>
<script src="{{ asset('stisla/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('stisla/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
@endsection

<!-- page script -->
@section('script')
<script src="{{ asset('js/pages/tagihan.js') }}"></script>
<script>
  
  $(document).ready(function(){
    refreshTableTagihanDataTable()
  })
</script>
@endsection