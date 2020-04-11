@extends('layouts.stisla')

@section('libraries-style')
<link rel="stylesheet" href="{{ asset('stisla/modules/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{ $title }} Siswa</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">Siswa</a></div>
      <div class="breadcrumb-item"><a href="#">{{ $title }}</a></div>
    </div>
  </div>

  <div class="section-body">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
      <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
        {{ @csrf_field() }}
        <input type="hidden" name="_method" value="{{ $_method }}">
        <div class="card-header">
            <h4 class="form-title">Form Tambah Siswa</h4>
        </div>
        <div class="card-body">
            <!-- nis -->
            <div class="form-group row">
              <label for="nis" class="col-md-2 col-12 control-label">Nis</label>
              <div class="col-md-10 col-12">
                <input type="text" class="form-control @error('nis') is-invalid  @enderror" name="nis" 
                  autocomplete="off" value="{{ (old('nis')) ? old('nis') : (isset($siswa)) ? $siswa->nis : '' }}" 
                  autofocus>
                @error('nis')
                <div class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </div>
                @enderror 
              </div>
            </div>
            
            <!-- Nama -->
            <div class="form-group row">
              <label for="nama" class="col-md-2 col-12">Nama</label>
              <div class="col-md-10 col-12">
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                  autocomplete="off" value="{{ ( old('nama') ) ? old('nama') : (isset($siswa)) ? $siswa->nama : '' }}" 
                  required>
                @error('nama') 
                <div class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </div>
                @enderror
              </div>
            </div>
            <!-- Status Select2-->
            <div class="form-group row">
              <label for="status" class="col-md-2 col-12">Status</label>
              <div class="col-md-10 col-12">
                <select name="status" id="status-siswa-select2" class="form-control @error('status') is-invalid @enderror"></select>
                @error('status')
                  <strong>{{ $message }}</strong>
                @enderror
              </div>
            </div>

            <!-- Kelas Select2 -->
            <div class="form-group row">
              <label for="kelas" class="col-md-2 col-12">Kelas</label>
              <div class="col-md-10 col-12">
                <select name="kelas" id="kelas-select2" class="form-control @error('kelas') is-invalid  @enderror"></select>
              </div>
              @error('kelas')
                <strong>{{ $message }}</strong>
              @enderror
            </div>


        </div>
        <div class="card-footer text-right">
          	<button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection

<!-- another javascript libraries -->
@section('libraries-script')
<script src="{{ asset('stisla/modules/select2/dist/js/select2.full.min.js') }}"></script>
@endsection

<!-- page script -->
@section('script')
<script src="{{ asset('js/pages/siswa.js') }}"></script>
<script src="{{ asset('js/pages/kelas.js') }}"></script>
<script>
$(document).ready(function(){
  const selected_kelas = "{{ (isset($siswa)) ? $siswa->kelas->id : '' }}";
  const selected_status = "{{ (isset($siswa)) ? $siswa->status->id : '' }}";
  
  kelasSelect2()
  statusSiswaSelect()
})
</script>
@endsection