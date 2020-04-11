@extends('layouts.stisla')

@section('libraries-style')

@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>{{ ( $form == 'create') ? 'Tambah'  : 'Edit' }} Kelas</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('kelas.index') }}">Kelas</a></div>
      <div class="breadcrumb-item"><a href="#">{{ ( $form == 'create') ? 'Tambah'  : 'Edit' }}</a></div>
    </div>
  </div>

  <div class="section-body">
    <h2 class="section-title">Form {{ ( $form == 'create') ? 'Tambah'  : 'Edit' }} Kelas</h2>
    <p class="section-lead">Halaman ini digunakan untuk {{ ( $form == 'create') ? 'menambah'  : 'merubah' }} kelas.</p>
    <div class="card card-primary">
      <div class="card-body">
            <div class="card-header">
                <h4>Form Tambah Kelas</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-primary alert-dismissible show fade">
                    <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('success') }}
                    </div>
                </div>
                @endif
                <form href="#" action="{{ ( $form == 'create') ? route('kelas.store')  : route('kelas.update', ['kela'=>@$kelas->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ ( $form == 'create') ? method_field('POST')  : method_field('PUT') }}
                    <!-- Nama Kelas --->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" 
                            value="{{ (old('nama')) ? old('nama') : @$kelas->nama }}" autocomplete="off" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <!-- Tingkat -->
                    <div class="form-group">
                        <label>Tingkat</label>
                        <select name="tingkat" id="tingkat" class="form-control @error('tingkat') is-invalid @enderror">
                            @foreach([1,2,3,4,5,6] as $tingkat)
                                @if(old('tingkat'))
                                <option value="{{ $tingkat }}" 
                                    {{ ($tingkat == old('tingkat') ) ? 'selected' : '' }}>{{ $tingkat }}</option>
                                @else
                                <option value="{{ $tingkat }}" 
                                    {{ ($tingkat == @$kelas->tingkat ) ? 'selected' : '' }}>{{ $tingkat }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('tingkat')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <div class="text-right">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
            </div>
      </div>
      <div class="card-footer bg-whitesmoke">
        This is card footer
      </div>
    </div>
  </div>
</section>
@endsection

<!-- another javascript libraries -->
@section('libraries-script')

@endsection

<!-- page script -->
@section('script')

@endsection