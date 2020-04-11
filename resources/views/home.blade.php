@extends('layouts.stisla')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>

  <div class="section-body">
    <div class="col-lg-6 col-12">
      <!-- Chart Master Siswa -->
      <div class="card card-primary">
        <div class="card-header">
          <h4>Master Siswa</h4>
          <div class="card-header-action">
            <a href="{{ route('siswa.index') }}" class="btn btn-primary">Go To Siswa</a>
          </div>
        </div>
        
        <div class="card-body">
          <canvas id="chart-siswa"></canvas>
        </div>
        <div class="card-footer">
          <ul class="list-unstyled list-unstyled-border">
            <li class="media"></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('libraries-script')
<script src="{{ asset('stisla/modules/chart.min.js') }}"></script>
@endsection

@section('script')
<script src="{{ asset('js/home.js') }}"></script>
@endsection