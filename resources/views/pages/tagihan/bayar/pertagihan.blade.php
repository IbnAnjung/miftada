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
    <h1>Bayar Tagihan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="{{ route('tagihan.index') }}">Tagihan</a></div>
      <div class="breadcrumb-item"><a href="{{ route('tagihan.bayar.index') }}">Bayar</a></div>
      <div class="breadcrumb-item active"><a href="#">per-tagihan</a></div>
    </div>
  </div>

  <div class="section-body">
    <div class="section-title">FORM PEMBAYARAN TAGIHAN PER-TAGIHAN</div>
   <!-- form input Pembayaran -->
   <div class="card card-primary">
        <form class="form-horizontal row">
            <div class="card-body">
                <div class="form-group row">
                    <label for="tagihan" class="control-label col-md-3">Tagihan</label>
                    <div class="col-md-9">
                        <select name="tagihan" id="tagihan" class="form-control"></select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="siswa" class="control-label col-md-3">Siswa</label>
                    <div class="col-md-5">
                        <select name="siswa" id="siswa" class="form-control" multiple></select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="kelas" id="kelas" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="total_tagihan" class="control-label col-md-3">Total</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="total_tagihan" id="total-tagihan" readonly>
                    </div>
                    <div class="col-md-5 text-right">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>   
            </div>
        </form>
        
        <div class="card-footer text-right">
          
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