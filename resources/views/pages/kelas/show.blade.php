@extends('layouts.stisla')

@section('libraries-style')

@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Detail Kelas</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('kelas.index') }}">Kelas</a></div>
      <div class="breadcrumb-item"><a href="#">Detail</a></div>
    </div>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Kelas {{$kelas->nama}}</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-6">
            <table class="table">
              <tr>
                <th>WaliKelas</th>
                <th>:</th>
                <th>Angga Saputra</th>
              </tr>
              <tr>
                <th>Total Siswa</th>
                <th>:</th>
                <th>{{ $kelas->siswas->count() }} Siswa</th>
              </tr>
            </table>
          </div>
          <div class="col-12 col-md-6 mb-3">
            <table class="table">
              <tr>
                <th>Tunggakan Tagihan</th>
                <th>:</th>
                <th>Rp 2.350.000,00</th>
              </tr>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table class="table table-stipred table-hover" id="table-siswa-dalam-kelas">
                <thead> 
                 <tr>
                  <th>Nis</th>
                  <th>Nama</th>
                  <th>Status</th>
                  <th>Tagihan</th>
                 </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
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
@endsection

<!-- page script -->
@section('script')
<script src="{{ asset('js/pages/kelas.js') }}"></script>
<script>
$(document).ready(function(){
  refreshTableSiswaDalamKelas("{{ $kelas->id }}")
})
</script>
@endsection