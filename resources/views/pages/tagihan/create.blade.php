@extends('layouts.stisla')

@section('libraries-style')
<link rel="stylesheet" href="{{ asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Tagihan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="#">Tagihan</a></div>
      <div class="breadcrumb-item active"><a href="#">Baru</a></div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">Terbitkan Tagihan</h2>
    <p class="section-lead">Halaman ini berfungsi untuk menerbitkan tagihan baru terhadap siswa.</p>
    <div class="card">
      <div class="card-header">
        <h4>Form Terbitkan Tagihan</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('tagihan.store') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
            
            {{ csrf_field() }}
            
            <!-- row keterangan tagihan -->
            <div class="form-group">
                <label for="ketarangan" class="control-label">Keterangan</label>
                <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                    value="{{ old('keterangan') }}" autocomplete='off'>
                @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <!-- End Row Keterangan tagihan -->
 
            <!-- row kelas -->
            <div class="form-group">
                <label for="kelas" class="control-label">Untuk siapa tagihan ini ?</label>
                <select name="kelas[]" id="kelas-select2" class="form-control select2" multiple="yes"></select>
            </div>

            <div class="form-group row">
                <!-- row Nominal -->
                <div class="col-md-6 col-12">
                    <label for="nominal" class="control-label">Nominal</label>
                    <input type="text" class="form-control format_uang @error('nominal') is-invalid @enderror" name="nominal"
                        value="{{ (old('nominal')) ? old('nominal'): 0 }}">
                    @error('nominal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!--end row Nominal -->

                <!-- row Tanggal -->
                <div class="col-md-6 col-12">
                    <label for="tanggal" class="control-label">tanggal</label>
                    <input type="text" class="form-control datepicker @error('tanggal') is-invalid @enderror" name="tanggal"
                        value="{{ ( old('tanggal') ) ? old('tanggal') : (isset($tagihan)) ? $tagihan->tanggal : date('Y-m-d') }}">
                    @error('tanggal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!-- End row tanggal -->
            </div>
            
            <!-- row tombol -->
            <div class="form-group">
                <div class="offset-md-10 col-12 col-md-2">
                    <button class="btn btn-primary btn-block btn-shadow" type="submit">Tambah</button>
                </div>
            </div>
            <!-- end row tombol -->
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

<!-- another javascript libraries -->
@section('libraries-script')
<script src="{{ asset('stisla/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection

<!-- page script -->
@section('script')
<script src="{{ asset('js/pages/kelas.js') }}"></script>
<script src="{{ asset('js/pages/tagihan.js') }}"></script>

<script>
$(document).ready(function(){
    kelasSelect2()
})
</script>
@endsection
