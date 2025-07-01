<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header">
            @if (auth()->user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/logo/logo-recycloV2.png') }}" alt="navbar brand" class="navbar-brand" height="60">
                </a>
            @endif
            @if (auth()->user()->role == 'petugas')
                <a href="{{ route('petugas.dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/logo/logo-recycloV2.png') }}" alt="navbar brand" class="navbar-brand" height="60">
                </a>
            @endif
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                @if (auth()->user()->role == 'admin')
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            <p>Beranda</p>
                        </a>
                    </li>

                    <!-- Data Master -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#data-master" class="collapsed" aria-expanded="false">
                            <i class="bi bi-collection"></i>
                            <p>Kelola Data</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="data-master">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.nasabah.index') }}">
                                        <span class="sub-item">Nasabah</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.petugas.index') }}">
                                        <span class="sub-item">Petugas</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.sampah.index') }}">
                                        <span class="sub-item">Jenis Sampah</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.pengepul.index') }}">
                                        <span class="sub-item">Pengepul</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.hadiah.index') }}">
                                        <span class="sub-item">Hadiah & Voucher</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Konten Digital -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#manajemen-konten" class="collapsed" aria-expanded="false">
                            <i class="bi bi-images"></i>
                            <p>Konten Digital</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="manajemen-konten">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.banner.index') }}">
                                        <span class="sub-item">Banner</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.artikel.index') }}">
                                        <span class="sub-item">Artikel Edukasi</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Aktivitas -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#transaksi" class="collapsed" aria-expanded="false">
                            <i class="bi bi-arrow-left-right"></i>
                            <p>Aktivitas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="transaksi">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.transaksi.index') }}">
                                        <span class="sub-item">Setoran Sampah</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tarik-saldo.index') }}">
                                        <span class="sub-item">Penarikan Saldo</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.penukaran-hadiah') }}">
                                        <span class="sub-item">Redeem Hadiah</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.pengiriman.index') }}">
                                        <span class="sub-item">Pengiriman</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Laporan & Cetak -->
                    <li class="nav-item">
                        <a href="{{ route('admin.laporan.index') }}">
                            <i class="bi bi-printer"></i>
                            <p>Laporan & Cetak</p>
                        </a>
                    </li>

                    <!-- Pengaturan Sistem -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#pengaturan" class="collapsed" aria-expanded="false">
                            <i class="bi bi-gear"></i>
                            <p>Pengaturan Sistem</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="pengaturan">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('admin.token-whatsapp.index') }}">
                                        <span class="sub-item">Token WhatsApp</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.aplikasi.index') }}">
                                        <span class="sub-item">Update Aplikasi</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.tentang_kami.index') }}">
                                        <span class="sub-item">Tentang Recyclo</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Aspirasi & Saran -->
                    <li class="nav-item">
                        <a href="{{ route('admin.feedback.index') }}">
                            <i class="bi bi-chat-dots"></i>
                            <p>Aspirasi & Saran</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'petugas')
                    <!-- Beranda -->
                    <li class="nav-item">
                        <a href="{{ route('petugas.dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            <p>Beranda</p>
                        </a>
                    </li>

                    <!-- Data Nasabah -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#data-master" class="collapsed" aria-expanded="false">
                            <i class="bi bi-people"></i>
                            <p>Data Nasabah</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="data-master">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('petugas.nasabah.index') }}">
                                        <span class="sub-item">Daftar Nasabah</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Aktivitas Petugas -->
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#transaksi" class="collapsed" aria-expanded="false">
                            <i class="bi bi-arrow-left-right"></i>
                            <p>Aktivitas Petugas</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="transaksi">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('petugas.transaksi.index') }}">
                                        <span class="sub-item">Setoran Nasabah</span>
                                    </a>
                                </li>
                                <li>
                                <a href="/petugas/pengajuan-saldo/create">
                                    <span class="sub-item">Pengajuan Saldo</span>
                                </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Logout -->
                <li class="nav-item">
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <p>Keluar</p>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
