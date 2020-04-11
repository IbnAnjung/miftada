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
      <div class="breadcrumb-item active"><a href="#">Potongan</a></div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">Potong Tagihan</h2>
    <p class="section-lead">Halaman ini berfungsi untuk memberikan potongan baik full atau tidak kepada siswa, berdasarkan statusnya.</p>
    <div class="card">
      <div class="card-header">
        <h4>Form Tambah Potongan Tagihan</h4>
      </div>
      <div class="card-body">
        <ul class="nav nav-pills" id="myTab3" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="siswa" data-toggle="tab" href="#tabSiswa" role="tab" aria-controls="home" aria-selected="true">Siswa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="status" data-toggle="tab" href="#tabStatus" role="tab" aria-controls="profile" aria-selected="false">Status Siswa</a>
          </li>
        </ul>
        <div class="tab-content" id="tabContent">
          <!-- Tab Siswa -->
          <div class="tab-pane fade show active" id="tabSiswa" role="tabpanel" aria-labelledby="siswa">
            <form class='form-horizontal' action="{{ route('tagihan.potongan.siswa', ['id'=> $tagihan->id]) }}" 
                id="form-potongan-siswa" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group row">
                <label for="siswa" class="col-md-2 control-label">Siswa</label>
                <div class="col-md-10 col-12">
                  <select name="siswa[]" id="siswa-select2" class="form-control" multiple="yes"></select>
                </div>
              </div>
              <div class="form-group row">
                <label for="nominal" class="col-md-2 control-label">Nominal</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="nominal" value="0">
                </div>
                <div class="col-md-2 text-right">
                  <button class="btn btn-block btn-shadow btn-primary" type="submit" onsubmit="simpanPotongan(this)">Simpan</button>
                </div>
              </div>
            </form>
          </div>
          <!-- End Tab Siswa -->

          <!-- Tab Status -->
          <div class="tab-pane fade" id="tabStatus" role="tabpanel" aria-labelledby="status">
            <form class='form-horizontal' action="{{ route('tagihan.potongan.status-siswa', ['id'=> $tagihan->id]) }}" 
                id="form-potongan-status-siswa" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="form-group row">
                <label for="siswa" class="col-md-2 control-label">Siswa</label>
                <div class="col-md-10 col-12">
                  <select name="siswa" id="status-siswa-select2" style="width:100%;" class="form-control" multiple="yes"></select>
                </div>
              </div>
              <div class="form-group row">
                <label for="nominal" class="col-md-2 control-label">Nominal</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="nominal" value="0">
                </div>
                <div class="col-md-2 text-right">
                  <button class="btn btn-block btn-shadow btn-primary" type="submit">Simpan</button>
                </div>
              </div>
            </form>  
          </div>
          <!-- End Tab Status -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

<!-- another javascript libraries -->
@section('libraries-script')
<script src="{{ asset('stisla/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('stisla/modules/sweetalert/sweetalert.min.js') }}"></script>
@endsection

<!-- page script -->
@section('script')
<script src="{{ asset('js/pages/siswa.js') }}"></script>
<script src="{{ asset('js/pages/tagihan.js') }}"></script>

<script>
$(document).ready(function(){
  siswaSelect()
  statusSiswaSelect2()
})
</script>
@endsection