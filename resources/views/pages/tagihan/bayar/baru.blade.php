@extends('layouts.stisla')

@section('libraries-style')
<link rel="stylesheet" href="{{ asset('stisla/modules/prism/prism.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/izitoast/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Bayar Tagihan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="#">Tagihan</a></div>
      <div class="breadcrumb-item active"><a href="#">Bayar</a></div>
    </div>
  </div>

  <div class="section-body">
    <div class="section-title">FORM PEMBAYARAN TAGIHAN</div>
   <!-- form input Pembayaran -->
    <form class="row form-horizontal form-pembayaran" action="{{ route('tagihan.pembayaran.baru.') }}" enctype='multipart/form-data'>
        {{ csrf_field() }}
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">Form Pembayaran Tagihan</div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="siswa" class="control-label col-md-3">siswa</label>
                        <div class="col-md-9">
                            <select name="siswa" id="siswa-select2" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tagihan" class="control-label col-md-3">Tagihan</label>
                        <div class="col-md-9">
                            <select name="tagihan" id="tagihan-siswa-select2" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nominal" class="control-label col-md-3">Nominal</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="nominal" readonly>
                        </div>
                        <label for="potongan" class="control-label col-md-3">Potongan</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id='potongan' readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="terbayar" class="col-md-3 control-label">Terbayar</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="terbayar">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bayar" class="control-label col-md-3">Bayar</label>
                        <div class="col-md-6">
                            <input type="text" name="bayar" id="bayar" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bayar" class="control-label col-md-3">Tanggal</label>
                        <div class="col-md-6">
                        <input type="text" name="tanggal" id="tanggal" class="form-control singledatepicker">
                        </div>
                        <div class="col-md-3 text-right">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="card-title text-right">
                
                </div>
            </div>
        </div>
    </form>

    <!-- Menu Input Cepat --> 
    <div class="section-title">MENU PEMBAYARAN TAGIHAN</div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Per Siswa</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">Metode Ini digunakan untuk input data pembayaran per Siswa & Pembayaran langsung <b>LUNAS</b>, Kamu hanya bisa memilih 1 siwa saja
                        tapi kamu bisa memilih lebih dari 1 jenis tagihan yang di miliki siswa tersebut.</p>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('tagihan.pembayaran.baru.per-siswa') }}" class="btn btn-success" target="_blank">Click di sini</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Per Tagihan</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">Metode ini digunakan untuk input data pembayaran per Jenis Tagihan, Kamu hanya bisa memilih 1 jenis Tagihan
                    tapi kamu bisa memilih lebih dari 1 orang siswa. Jika ini dilakukan setiap siswa yang di input bersamaan harus memiliki <b>TOTAL BAYAR YANG SAMA</b>.</p>
                </div>
                <div class="card-footer text-right">
                <a href="{{ route('tagihan.pembayaran.baru.per-tagihan') }}" class="btn btn-success" target="_blank">Click di sini</a></div>
            </div>
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
<script src="{{ asset('stisla/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('stisla/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection

<!-- page script -->
@section('script')
<script src="{{ asset('js/pages/siswa.js') }}"></script>
<script src="{{ asset('js/pages/bayarTagihan.js') }}"></script>
<script>
  
  $(document).ready(function(){
    siswaSelect()
    $('#siswa-select2').select2('open');
  })
</script>
@endsection