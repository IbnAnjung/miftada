<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Miftada</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">MF</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li><a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
      <!-- Master -->
      <li class="menu-header">Master</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('kelas.index') }}">Kelas</a></li>
          <li><a class="nav-link" href="{{ route('siswa.index') }}">Siswa</a></li>
        </ul>
      </li>
      <!-- End Master -->

      <!-- Tagihan -->
      <li class="menu-header">Transaksi</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Tagihan</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('tagihan.create') }}">Baru</a></li>
          <li><a class="nav-link" href="{{ route('tagihan.index') }}">Rekap</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Pembayaran</span></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('tagihan.pembayaran.baru.') }}" class="nav-link">Baru</a></li>
          <li><a href="{{ route('tagihan.pembayaran.rekap') }}" class="nav-link">Rekap</a></li>
        </ul>
      </li>
      <!-- End Tagihan -->
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Documentation
      </a>
    </div>       
  </aside>
</div>