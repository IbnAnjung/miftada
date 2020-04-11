@extends('layouts.stisla')

@section('libraries-style')

@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Detail Siswa</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('siswa.index') }}">Siswa</a></div>
      <div class="breadcrumb-item"><a href="#">Detail</a></div>
    </div>
  </div>

  <div class="section-body">
    <div class="card card-primary">
      <div class="card-header">
        <h4>Detail Siswa</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-6">
            <table class="table">
                <tr>
                    <th>Nis</th>
                    <th>: {{ $siswa->nis }}</th>
                </tr>
                <tr>
                    <th>Nama</th>
                    <th>: {{ $siswa->nama }}</th>
                </tr>
            </table>
          </div>
          <div class="col-12 col-md-6 mb-3">
            <table class="table">
                <tr>
                    <th>Status</th>
                    <th>: {{ $siswa->status->keterangan }}</th>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <th>: {{ $siswa->kelas->tingkat }} {{ $siswa->kelas->nama }}</th>
                </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="card card-warning">
        <div class="card-header">
            <h4 class="card-title">Detail Tunggakan</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <th>Tanggal Terbit</th>
                    <th>Keterangan</th>
                    <th>Tagihan</th>
                    <th>Potongan</th>
                    <th>Terbayar</th>
                    <th>Tunggakan</th>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" align="right">Total</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
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
<script src="{{ asset('js/pages/siswa.js') }}"></script>
<script>
$(document).ready(function(){
})
</script>
@endsection