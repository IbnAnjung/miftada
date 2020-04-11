@extends('layouts.stisla')

@section('libraries-style')
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Master Kelas</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Kelas</a></div>
    </div>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Daftar Kelas</h4>
        <div class="card-header-action">
            <a href="{{ route('kelas.nonaktif') }}" class="btn btn-danger">
                <i class="fa fa-trash"></i> Kelas Non Aktif
            </a>
            <a href="{{ route('kelas.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
            </a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="table-master-kelas">
                <thead>
                    <tr>    
                        <th>Tingkat</th>
                        <th>Nama Kelas</th>
                        <th>Jumlah Siswa</th>
                        <th>aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
      </div>
      <div class="card-footer bg-whitesmoke">
        
      </div>
    </div>
  </div>
</section>
@endsection

<!-- another javascript libraries -->
@section('libraries-script')
<script src="{{ asset('stisla/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('stisla/modules/sweetalert/sweetalert.min.js') }}"></script>
@endsection

<!-- page script -->
@section('script')
<script src="{{ asset('js/pages/kelas.js') }}"></script>
<script>
  
  $(document).ready(function(){
      refreshTableKelas()
  })
</script>
@endsection