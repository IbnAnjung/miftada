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
      <div class="breadcrumb-item"><a href="{{ route('tagihan.index') }}">Tagihan</a></div>
      <div class="breadcrumb-item active"><a href="#">Detail</a></div>
    </div>
  </div>

  <div class="section-body">
    <div class="section-title">Detail Tagihan</div>
    <div class="card">
      <div class="card-header">
        <h4>{{ $tagihan->keterangan }}</h4>
        <div class="card-header-action">
          <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
        </div>
      </div>
      <div class="collapse show" id="mycard-collapse">
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <td>Terbit</td>
              <td>{{ date("d-m-Y", strtotime($tagihan->tanggal_terbit)) }}</td>
            </tr>
            <tr>
              <td>Nominal</td>
              <td>Rp {{ number_format($tagihan->nominal, 2, ',', '.') }}</td>
            </tr>
          </table>
        </div>
        <div class="card-footer">
          
        </div>
      </div>
    </div>

    <div class="section-title">Daftar Tagihan Siswa</div>
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Tagihan Siswa</h4>
      </div>
      <div class="card-body">
        <table class="table table-striped" id="table-daftar-tagihan-siswa">
          <thead>
            <tr>
              <th>Nis</th>
              <th>Nama</th>
              <th>Potongan</th>
              <th>Bayar</th>
              <th>Rubah</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@component('components.modals.modal-input',[
    'id' => 'modal-edit-tagihan-siswa'
    ])
  @slot('title')
    Form Edit Tagihan Siswa
  @endslot
  <div class="form-group row">
      <label for="namaTagihan" class="col-form-label col-md-2">Tagihan</label>
      <div class="col-md-10">
          <input type="text" class='form-control' id='nama-tagihan'  name='nama_tagihan' value="" readonly>
      </div>
  </div>
  <div class="form-group row">
    <label for="namaSiswa" class="col-form-label col-md-2">Siswa</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="nama-siswa" name='nama_siswa' value="" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="totalTagihan" class="col-form-label col-md-2">Nominal</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="total-tagihan" name='total_tagihan' readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="potongan" class="col-form-label col-md-2">Potongan</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="potongan" name="potongan" autocomplete="off" autofocus>
    </div>
  </div>
@endcomponent

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
  const id_tagihan = "{{ $tagihan->id }}"
  $(document).ready(function(){
    refreshTableDaftarSiswaTagihanDataTable(id_tagihan)
  })
</script>
@endsection