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
    <h1>Siswa</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Siswa</a></div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-sm-11 col-md-6">
        <div class="section-title" style="margin:1px;">Status Siswa</div>
      </div>
      <div class="col-sm-11 col-md-6 text-right">
        <button class="btn btn-primary trigger--fire-modal-tambah-status-siswa" id="tambah-status-siswa">
          <i class="fa fa-plus"></i> Status
          </button>
      </div>
    </div>
    <!-- Status Siswa -->
    <div class="row">
    @foreach($statusSiswa as $status)
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>{{ $status->keterangan }}</h4>
            </div>
            <div class="card-body">
            {{ ($nonaktif) ? $status->siswas()->onlyTrashed()->count() : $status->siswas->count() }} Siswa
            </div>
        </div>
        </div>
    </div>
    @endforeach
    </div>

    <div class="section-title">Daftar Siswa</div>
    <div class="card">
      <div class="card-header">
        <h4>Daftar Siswa</h4>
        <div class="card-header-action">
          <a href="{{ route('siswa.index') }}{{ ($nonaktif) ? '' : '?nonaktif=true' }}" class="btn {{($nonaktif) ? 'btn-success' : 'btn-danger' }}">
              <i class="fa {{ ($nonaktif) ? 'fa-people' : 'fa-trash' }}"></i> {{ ($nonaktif) ? 'Siswa Aktif' : 'Siswa Non Aktif' }}
          </a>
          @if(!$nonaktif)
          <a href="{{ route('siswa.create') }}" class="btn btn-primary">
              <i class="fa fa-plus"></i>
          </a>
          @endif
        </div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover" id="table-siswa">
          <thead>
            <tr>
              <th>NIS</th>
              <th>Nama</th>
              <th>Status</th>
              <th>Tingkat</th>
              <th>Kelas</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div class="card-footer bg-whitesmoke">
        This is card footer
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
<script src="{{ asset('js/pages/siswa.js') }}"></script>
<script>
  const nonaktif = "{{ $nonaktif }}";
  
  $(document).ready(function(){
    refreshTableSiswa()
  })
</script>
@endsection