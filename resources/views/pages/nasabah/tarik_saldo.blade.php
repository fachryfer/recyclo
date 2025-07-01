<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Recyclo - Sistem Informasi Bank Sampah" />
    <meta name="author" content="Recyclo" />
    <title>Recyclo - Tarik Saldo</title>
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo-recyclo-favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/recyclo.css') }}">
</head>

<body>
    <!-- Sidebar Overlay & Drawer -->
    <div class="sidebar-overlay" id="sidebarOverlay" style="display:none;"></div>
    <nav class="sidebar" id="sidebarNav">
        <div class="sidebar-header">
            <img src="{{ asset('assets/img/logo/logo-recycloV2.png') }}" alt="Recyclo Logo" style="height:40px;">
            <button class="sidebar-close" id="sidebarClose"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="sidebar-menu">
            <a href="#" class="sidebar-link">Cara kerja</a>
            <a href="#features" class="sidebar-link">Fitur</a>
            <div class="sidebar-dropdown">
                <a href="#products" class="sidebar-link">Produk</a>
                <div class="sidebar-dropdown-content">
                    <div class="dropdown-heading">Hadiah yang tersedia</div>
                    <a href="#products" class="dropdown-link">Voucher Belanja</a>
                    <a href="#products" class="dropdown-link">Saldo E-Wallet</a>
                    <a href="#products" class="dropdown-link">Pulsa & Paket Data</a>
                    <a href="#products" class="dropdown-link">Voucher Game</a>
                </div>
            </div>
            <div class="sidebar-dropdown">
                <a href="#sampah" class="sidebar-link">Sampah</a>
                <div class="sidebar-dropdown-content">
                    <div class="dropdown-heading">Jenis sampah yang bisa dijual</div>
                    @foreach(array_slice($sampahs->where('gambar','!=',null)->all(),0,6) as $sampah)
                        <a href="#sampah" class="dropdown-link">{{ $sampah->nama_sampah }}</a>
                    @endforeach
                </div>
            </div>
            <div class="sidebar-dropdown">
                <a href="#" class="sidebar-link">Reedem</a>
                <div class="sidebar-dropdown-content">
                    <div class="dropdown-heading">Tarik Saldo & Penukaran Hadiah</div>
                    <a href="{{ route('nasabah.tarik-saldo') }}" class="dropdown-link">Penarikan Saldo</a>
                    <a href="{{ route('nasabah.penukaran-hadiah.index') }}" class="dropdown-link">Penukaran Hadiah</a>
                </div>
            </div>
            @if(Session::has('nasabah_id'))
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="sidebar-link">
                        <i></i>Logout
                    </a>
                </form>
            @endif
            <div class="sidebar-buttons mt-4">
                @if(Session::has('nasabah_id'))
                    <div class="profile-badge d-flex flex-column align-items-center p-2" style="min-width:140px;">
                        <span class="profile-icon mb-1" style="background:#2E8B57;color:#fff;border-radius:50%;width:34px;height:34px;display:flex;align-items:center;justify-content:center;font-size:18px;"><i class="bi bi-person-circle"></i></span>
                        <span class="fw-bold text-primary mb-1" style="font-size:14px;">{{ Session::get('nasabah_nama') }}</span>
                        <div class="small text-center" style="font-size:13px;">
                            <span class="text-success d-block">Saldo: Rp {{ number_format((float)Session::get('nasabah_saldo'), 0, ',', '.') }}</span>
                            <span class="text-primary d-block">Poin: {{ number_format((float)Session::get('nasabah_poin'), 0, ',', '.') }}</span>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline w-100 mb-2">Login</a>
                    <a href="#customer-service" class="btn btn-primary w-100">Daftar</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container" style="display:flex;align-items:center;justify-content:space-between;max-width:1200px;margin:0 auto;padding:0 20px;">
            <div style="flex:0 0 auto;display:flex;align-items:center;">
                <button class="navbar-hamburger" id="sidebarOpen"><i class="bi bi-list"></i></button>
                <a href="{{ route('welcome') }}" class="navbar-logo">
                    <img src="{{ asset('assets/img/logo/logo-recycloV2.png') }}" alt="Recyclo Logo" style="height:50px;vertical-align:middle;">
                </a>
            </div>
            <div class="navbar-menu" style="flex:1 1 0;display:flex;gap:30px;align-items:center;justify-content:center;text-align:center;">
                <a href="{{ url('/#') }}" class="navbar-link">Cara kerja</a>
                <a href="{{ url('/#features') }}" class="navbar-link">Fitur</a>
                <div class="dropdown">
                    <a href="{{ url('/#products') }}" class="navbar-link">Produk</a>
                    <div class="dropdown-content">
                        <div class="dropdown-heading">Hadiah yang tersedia</div>
                        <a href="#" class="dropdown-link">Voucher Belanja</a>
                        <a href="#" class="dropdown-link">Saldo E-Wallet</a>
                        <a href="#" class="dropdown-link">Pulsa & Paket Data</a>
                        <a href="#" class="dropdown-link">Voucher Game</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="{{ url('/#sampah') }}" class="navbar-link">Sampah</a>
                    <div class="dropdown-content">
                        <div class="dropdown-heading">Jenis sampah yang bisa dijual</div>
                        @foreach(array_slice($sampahs->where('gambar','!=',null)->all(),0,6) as $sampah)
                            <a href="{{ url('/#sampah') }}" class="dropdown-link">{{ $sampah->nama_sampah }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="navbar-link">Reedem</a>
                    <div class="dropdown-content">
                        <div class="dropdown-heading">Tarik Saldo & Penukaran Hadiah</div>
                        <a href="{{ route('nasabah.tarik-saldo') }}" class="dropdown-link">Penarikan Saldo</a>
                        <a href="{{ route('nasabah.penukaran-hadiah.index') }}" class="dropdown-link">Penukaran Hadiah</a>
                    </div>
                </div>
            </div>
            <div class="navbar-buttons" style="flex:0 0 auto;display:flex;align-items:center;">
                @if(Session::has('nasabah_id'))
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm" class="d-inline">
                        @csrf
                        <div class="profile-badge d-flex flex-column align-items-center p-2" style="min-width:160px;cursor:pointer;" onclick="document.getElementById('logoutForm').submit();background:#fff;">
                            <span class="fw-bold text-primary mb-1" style="font-size:14px;">{{ Session::get('nasabah_nama') }}</span>
                            <div class="small text-center" style="font-size:13px;">
                                <span class="text-success d-block">Saldo: Rp {{ number_format((float)Session::get('nasabah_saldo'), 0, ',', '.') }}</span>
                                <span class="text-primary d-block">Poin: {{ number_format((float)Session::get('nasabah_poin'), 0, ',', '.') }}</span>
                            </div>
                            <span class="logout-text mt-1" style="font-size:12px;color:#888;">Klik untuk logout</span>
                        </div>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                    <a href="#" class="btn btn-primary">Daftar</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-section">
                    <h3 class="form-title">Form Tarik Saldo</h3>

                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <strong>Saldo Tersedia:</strong> Rp {{ number_format((float)Session::get('nasabah_saldo'), 0, ',', '.') }}
                    </div>

                    <form action="{{ route('nasabah.tarik-saldo.store') }}" method="POST" id="pengajuanForm">
                        @csrf

                        <!-- Metode Pencairan -->
                        <div class="form-group">
                            <label for="metode_pencairan" class="form-label">Metode Pencairan</label>
                            <select name="metode_pencairan" id="metode_pencairan" class="form-select" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="tunai">💵 Tunai</option>
                                <option value="transfer">🏦 Transfer Bank</option>
                                <option value="dana">🟦 DANA</option>
                                <option value="ovo">🟪 OVO</option>
                                <option value="gopay">🟦 GoPay</option>
                                <option value="shopeepay">🟧 ShopeePay</option>
                            </select>
                        </div>

                        <!-- No Rekening -->
                        <div class="form-group">
                            <label for="no_rek" class="form-label">Nomor Rekening / No HP e-Wallet</label>
                            <input type="text" name="no_rek" id="no_rek" class="form-control" disabled>
                        </div>

                        <!-- Jumlah Pencairan -->
                        <div class="form-group">
                            <label for="jumlah_pencairan" class="form-label">Jumlah Pencairan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="jumlah_pencairan" id="jumlah_pencairan" class="form-control" required min="1000">
                            </div>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="bi bi-send-fill"></i>
                            Kirim Pengajuan
                        </button>
                    </form>
                </div>

                @if($pengajuanSaldo->count() > 0)
                    <div class="history-section">
                        <h4 class="history-title">Riwayat Pengajuan</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Metode</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengajuanSaldo as $pengajuan)
                                        <tr>
                                            <td data-label="Tanggal">{{ $pengajuan->tanggal_pengajuan->format('d/m/Y H:i') }}</td>
                                            <td data-label="Jumlah">Rp {{ number_format($pengajuan->jumlah_pencairan, 0, ',', '.') }}</td>
                                            <td data-label="Metode">
                                                <span class="bg-metode-pencairan">
                                                    @php
                                                        $logoFile = 'tunai.png'; // default logo
                                                        $metode = strtolower($pengajuan->metode_pencairan);

                                                        if (str_contains($metode, 'bank') || $metode === 'transfer') {
                                                            $logoFile = 'bank.png';
                                                        } elseif ($metode === 'ovo') {
                                                            $logoFile = 'ovo.png';
                                                        } elseif ($metode === 'dana') {
                                                            $logoFile = 'dana.png';
                                                        } elseif ($metode === 'gopay') {
                                                            $logoFile = 'gopay.png';
                                                        } elseif ($metode === 'shopeepay') {
                                                            $logoFile = 'shopeepay.png';
                                                        } elseif ($metode === 'tunai') {
                                                            $logoFile = 'tunai.png';
                                                        }
                                                    @endphp
                                                    <img src="{{ asset('assets/img/metode/' . $logoFile) }}" alt="{{ $pengajuan->metode_pencairan }}">
                                                    {{ ucfirst($pengajuan->metode_pencairan) }}
                                                </span>
                                            </td>
                                            <td data-label="Status">
                                                @if($pengajuan->status == 'pending')
                                                    <span class="badge badge-pending">Pending</span>
                                                @elseif($pengajuan->status == 'disetujui')
                                                    <span class="badge badge-approved">Disetujui</span>
                                                @else
                                                    <span class="badge badge-rejected">Ditolak</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <span class="footer-logo">RECYCLO</span>
                    <p class="footer-desc">Recyclo menyediakan layanan pengelolaan sampah daur ulang dengan sistem poin yang bisa ditukarkan dengan berbagai hadiah menarik seperti voucher belanja dan saldo e-wallet.</p>
                </div>
                
                <div class="footer-links-group">
                    <h3 class="footer-links-title">Pulsa</h3>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="#">Telkomsel</a></li>
                        <li class="footer-link"><a href="#">XL</a></li>
                        <li class="footer-link"><a href="#">Indosat</a></li>
                        <li class="footer-link"><a href="#">Tri</a></li>
                        <li class="footer-link"><a href="#">Smartfren</a></li>
                    </ul>
                </div>
                
                <div class="footer-links-group">
                    <h3 class="footer-links-title">E-money</h3>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="#">DANA</a></li>
                        <li class="footer-link"><a href="#">GoPay</a></li>
                        <li class="footer-link"><a href="#">OVO</a></li>
                        <li class="footer-link"><a href="#">ShopeePay</a></li>
                        <li class="footer-link"><a href="#">LinkAja</a></li>
                    </ul>
                </div>
                
                <div class="footer-links-group">
                    <h3 class="footer-links-title">Voucher belanja</h3>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="#">Indomaret</a></li>
                        <li class="footer-link"><a href="#">Alfamart</a></li>
                        <li class="footer-link"><a href="#">Tokopedia</a></li>
                        <li class="footer-link"><a href="#">MAP gift voucher</a></li>
                        <li class="footer-link"><a href="#">Google Play</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; 2025 Recyclo - Sistem Informasi Bank Sampah. All Rights Reserved.</p>
                
                <div class="footer-social">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/fachryfer_/" class="social-icon" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>
                    <a href="https://github.com/fachryfer" class="social-icon" target="_blank" rel="noopener"><i class="bi bi-github"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const metodeSelect = document.getElementById('metode_pencairan');
            const noRekInput = document.getElementById('no_rek');

            function toggleNoRek() {
                const metode = metodeSelect.value;
                if (metode && metode !== 'tunai') {
                    noRekInput.disabled = false;
                    noRekInput.required = true;
                } else {
                    noRekInput.disabled = true;
                    noRekInput.required = false;
                    noRekInput.value = '';
                }
            }

            metodeSelect.addEventListener('change', toggleNoRek);
            toggleNoRek();
        });
    </script>

    <!-- Navbar Scroll Script -->
    <script>
        let lastScrollTop = 0;
        const navbar = document.querySelector('.navbar');
        const scrollThreshold = 50; // Jarak scroll minimum untuk memicu perubahan

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
            
            // Jika scroll lebih dari threshold
            if (Math.abs(currentScroll - lastScrollTop) > scrollThreshold) {
                if (currentScroll > lastScrollTop && currentScroll > 100) {
                    // Scroll ke bawah
                    navbar.classList.add('hide');
                    navbar.classList.remove('show');
                } else {
                    // Scroll ke atas
                    navbar.classList.add('show');
                    navbar.classList.remove('hide');
                }
                lastScrollTop = currentScroll;
            }
        });
    </script>

    <script>
        // Sidebar logic
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebarNav');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const sidebarOpen = document.getElementById('sidebarOpen');
            const sidebarClose = document.getElementById('sidebarClose');
            // Buka sidebar
            sidebarOpen.addEventListener('click', function() {
                sidebar.classList.add('active');
                sidebarOverlay.classList.add('active');
            });
            // Tutup sidebar
            sidebarClose.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });
            // Dropdown sidebar
            document.querySelectorAll('.sidebar-dropdown > .sidebar-link').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parent = link.parentElement;
                    parent.classList.toggle('open');
                });
            });
        });
    </script>

    <script>
        // Fallback JS untuk submit logout jika onclick gagal
        document.addEventListener('DOMContentLoaded', function() {
            var badge = document.querySelector('.navbar-buttons .profile-badge');
            if (badge) {
                badge.addEventListener('click', function() {
                    var form = document.getElementById('logoutForm');
                    if (form) form.submit();
                });
            }
        });
    </script>
</body>
</html>