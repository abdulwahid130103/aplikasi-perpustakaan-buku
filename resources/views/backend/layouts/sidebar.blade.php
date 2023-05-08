<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" {{ route('dashboard') }} ">
      <img src="{{  asset('images/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">Perpus Kediri</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('dashboard') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 {{ Request::is('/') ? 'text-light' : 'text-primary' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      @if ( Auth::check() && Auth::user()->role == 'petugas')
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Componen</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('petugas/kategori') ? 'active' : '' }}" href="{{ url('petugas/kategori') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-calendar-grid-58 {{ Request::is('petugas/kategori') ? 'text-light' : 'text-warning' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Kategori</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('petugas/rak') ? 'active' : '' }}" href="{{ asset('petugas/rak') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card {{ Request::is('petugas/rak') ? 'text-light' : 'text-success' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Rak</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('petugas/buku') ? 'active' : '' }}" href="{{ asset('petugas/buku') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-app {{ Request::is('petugas/buku') ? 'text-light' : 'text-info' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Buku</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('petugas/detailBuku') ? 'active' : '' }}" href="{{ url('petugas/detailBuku') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-calendar-grid-58 {{ Request::is('petugas/detailBuku') ? 'text-light' : 'text-warning' }}  text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Detail Buku</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Transaksi</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('petugas/peminjaman') ? 'active' : '' }}" href="{{ url('petugas/peminjaman') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-calendar-grid-58 {{ Request::is('petugas/peminjaman') ? 'text-light' : 'text-warning' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Peminjaman</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('petugas/pengembalian') ? 'active' : '' }}" href="{{ url('petugas/pengembalian') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card {{ Request::is('petugas/pengembalian') ? 'text-light' : 'text-success' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Pengembalian</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Users</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('petugas/anggota') ? 'active' : '' }}" href="{{ url('petugas/anggota')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 {{ Request::is('petugas/anggota') ? 'text-light' : 'text-primary' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Anggota</span>
        </a>
      </li>
      @endif
      @if (Auth::check() && Auth::user()->role == 'admin')
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Users</h6>
      </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/petugas') ? 'active' : '' }}" href="{{ url('admin/petugas') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 {{ Request::is('admin/petugas') ? 'text-light' : 'text-primary' }} text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Petugas</span>
          </a>
        </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Log</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/logPetugas') ? 'active' : '' }}" href="{{  url('admin/logPetugas') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-calendar-grid-58 {{ Request::is('admin/logPetugas') ? 'text-light' : 'text-warning' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Log Petugas</span>
        </a>
      </li>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Laporan</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/laporanAnggota') ? 'active' : '' }}" href="{{  url('admin/laporanAnggota') }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card {{ Request::is('admin/laporanAnggota') ? 'text-light' : 'text-success' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Laporang anggota</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/laporanPetugas') ? 'active' : '' }}" href="{{ url('admin/laporanPetugas')  }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-app {{ Request::is('admin/laporanPetugas') ? 'text-light' : 'text-info' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Laporan Petugas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/laporanBuku') ? 'active' : '' }}" href="{{url('admin/laporanBuku')  }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-app {{ Request::is('admin/laporanBuku') ? 'text-light' : 'text-info' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Laporan Buku</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/laporanPeminjaman') ? 'active' : '' }}" href="{{ url('admin/laporanPeminjaman')  }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-world-2 {{ Request::is('admin/laporanPeminjaman') ? 'text-light' : 'text-danger' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Laporan peminjaman</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('admin/laporanPengembalian') ? 'active' : '' }}" href="{{ url('admin/laporanPengembalian')  }}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-credit-card {{ Request::is('admin/laporanPengembalian') ? 'text-light' : 'text-success' }} text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Laporang Pengembalian</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
</aside>

