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
            <div class="col-12">
                <div class="form-section">
                    <h3 class="form-title">Tukar Poin dengan Hadiah</h3>

                    @if(isset($error))
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ $error }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="alert alert-info">
                        <i class="bi bi-gem me-2"></i>
                        <strong>Poin Tersedia:</strong> {{ number_format(Session::get('nasabah_poin'), 0, ',', '.') }} poin
                    </div>

                    <form action="{{ route('nasabah.penukaran-hadiah.store') }}" method="POST" id="penukaranForm">
                        @csrf
                        <input type="hidden" name="hadiah_id" id="hadiah_id" required>
                        <input type="hidden" name="jumlah" id="jumlah_hidden" value="1">
                        <div class="voucher-grid" id="rewardCardList">
                            @forelse($hadiah as $item)
                                <div class="voucher-card reward-card-selectable {{ $item->stok <= 0 ? 'disabled' : '' }}"
                                    data-id="{{ $item->id }}"
                                    data-poin="{{ $item->jumlah_poin }}"
                                    data-stok="{{ $item->stok }}"
                                    data-nama="{{ $item->nama_hadiah }}"
                                    tabindex="0">
                                    <div class="voucher-img">
                                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_hadiah }}">
                                    </div>
                                    <div class="voucher-info">
                                        <div class="voucher-title">{{ $item->nama_hadiah }}</div>
                                        <div class="voucher-desc">{{ $item->deskripsi }}</div>
                                        <div class="voucher-tooltip">
                                            <div class="voucher-tooltip-title">{{ $item->nama_hadiah }}</div>
                                            <div class="voucher-tooltip-desc">{{ $item->deskripsi }}</div>
                                        </div>
                                        <div class="voucher-bottom-row">
                                            <span class="voucher-poin"><i class="bi bi-gem"></i> {{ number_format($item->jumlah_poin, 0, ',', '.') }} poin</span>
                                            <span class="voucher-stok {{ $item->stok > 0 ? 'tersedia' : 'habis' }}">{{ $item->stok > 0 ? 'Tersedia' : 'Habis' }}</span>
                                            <div class="input-jumlah-wrapper" style="display:none;">
                                                <span class="input-jumlah-label">Jumlah</span>
                                                <span class="input-jumlah-group">
                                                    <button type="button" class="input-jumlah-btn btn-minus">-</button>
                                                    <input type="number" min="1" max="{{ $item->stok }}" value="1" class="form-control jumlah-input">
                                                    <button type="button" class="input-jumlah-btn btn-plus">+</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center">Belum ada hadiah yang tersedia.</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="2" required placeholder="Contoh: Nomor Dana 0812xxxxxxx a.n. Facxxx Ferxxxxxxxx Semxxxxxx, atau catatan lain untuk admin/petugas" style="max-height:80px;resize:vertical;"></textarea>
                        </div>
                        <button type="submit" class="btn-submit w-100 mt-3" id="btnTukar" disabled>
                            <i class="bi bi-gift"></i>
                            Tukar Hadiah
                        </button>
                    </form>
                </div>

                @if(isset($riwayatPenukaran) && $riwayatPenukaran->count() > 0)
                    <div class="history-section">
                        <h4 class="history-title">Riwayat Penukaran Hadiah</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Hadiah</th>
                                        <th>Harga Reedem</th>
                                        <th>Keterangan</th>
                                        <th>Bukti</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayatPenukaran as $penukaran)
                                        <tr>
                                            <td data-label="Tanggal">{{ $penukaran->created_at ? $penukaran->created_at->format('d/m/Y H:i') : '-' }}</td>
                                            <td data-label="Hadiah">
                                                <span class="bg-hadiah" style="display:inline-flex;align-items:center;gap:6px;">
                                                    @if(isset($penukaran->hadiah->gambar) && $penukaran->hadiah->gambar)
                                                        <img src="{{ Storage::url($penukaran->hadiah->gambar) }}" alt="{{ $penukaran->hadiah->nama_hadiah }}" style="width:40px;height:40px;object-fit:contain;border-radius:4px;">
                                                    @else
                                                        <img src="{{ asset('assets/img/hadiah/default.png') }}" alt="-" style="width:40px;height:40px;object-fit:contain;border-radius:4px;">
                                                    @endif
                                                    {{ $penukaran->hadiah->nama_hadiah ?? '-' }}
                                                </span>
                                            </td>
                                            <td data-label="Harga Reedem">
                                                @php
                                                    $harga = ($penukaran->total_poin ?? $penukaran->jumlah_poin) && ($penukaran->total_poin ?? $penukaran->jumlah_poin) > 0 ? number_format(($penukaran->total_poin ?? $penukaran->jumlah_poin), 0, ',', '.') : '-';
                                                @endphp
                                                {{ $harga !== '-' ? $harga . ' poin' : '-' }}
                                            </td>
                                            <td data-label="Keterangan">{{ $penukaran->keterangan ?? '-' }}</td>
                                            <td data-label="Bukti">
                                                @if($penukaran->status == 'disetujui' && !empty($penukaran->gambar))
                                                    <a href="{{ asset('storage/penukaran_hadiah/' . $penukaran->gambar) }}" target="_blank" rel="noopener">
                                                        <img src="{{ asset('storage/penukaran_hadiah/' . $penukaran->gambar) }}" alt="Bukti" style="max-width:80px;max-height:80px;border-radius:6px;cursor:pointer;">
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td data-label="Status">
                                                @if($penukaran->status == 'pending')
                                                    <span class="badge badge-pending">Pending</span>
                                                @elseif($penukaran->status == 'disetujui')
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
            // Card selection logic
            const cardList = document.querySelectorAll('.reward-card-selectable');
            const hadiahInput = document.getElementById('hadiah_id');
            const jumlahHidden = document.getElementById('jumlah_hidden');
            const btnTukar = document.getElementById('btnTukar');
            let selectedCard = null;
            let selectedJumlahInput = null;

            function resetAllCards() {
                cardList.forEach(card => {
                    card.classList.remove('selected');
                    const inputWrapper = card.querySelector('.input-jumlah-wrapper');
                    const jumlahInput = card.querySelector('.jumlah-input');
                    if (inputWrapper) inputWrapper.style.display = 'none';
                    if (jumlahInput) jumlahInput.value = 1;
                });
            }

            cardList.forEach(card => {
                const jumlahInput = card.querySelector('.jumlah-input');
                const inputWrapper = card.querySelector('.input-jumlah-wrapper');
                const btnMinus = card.querySelector('.btn-minus');
                const btnPlus = card.querySelector('.btn-plus');
                // Prevent unselect when interacting with jumlah
                [inputWrapper, jumlahInput, btnMinus, btnPlus].forEach(el => {
                    el.addEventListener('mousedown', e => e.stopPropagation());
                    el.addEventListener('pointerdown', e => e.stopPropagation());
                    el.addEventListener('click', e => e.stopPropagation());
                    el.addEventListener('focus', e => e.stopPropagation());
                });
                // Card select logic
                card.addEventListener('click', function() {
                    if (selectedCard === card) {
                        // Unselect jika klik lagi
                        card.classList.remove('selected');
                        inputWrapper.style.display = 'none';
                        hadiahInput.value = '';
                        jumlahHidden.value = 1;
                        jumlahInput.value = 1;
                        btnTukar.disabled = true;
                        selectedCard = null;
                        selectedJumlahInput = null;
                        return;
                    }
                    // Reset semua card dan input jumlah
                    resetAllCards();
                    // Pilih card baru
                    card.classList.add('selected');
                    inputWrapper.style.display = 'flex';
                    hadiahInput.value = card.getAttribute('data-id');
                    jumlahInput.value = 1;
                    jumlahInput.max = card.getAttribute('data-stok');
                    jumlahInput.disabled = card.getAttribute('data-stok') <= 0;
                    jumlahHidden.value = 1;
                    btnTukar.disabled = card.getAttribute('data-stok') <= 0;
                    selectedCard = card;
                    selectedJumlahInput = jumlahInput;
                });
                card.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        card.click();
                    }
                });
                // Sync jumlah input ke hidden
                jumlahInput.addEventListener('input', function() {
                    jumlahHidden.value = jumlahInput.value;
                });
                // Plus/minus button logic
                btnMinus.addEventListener('click', function() {
                    let val = parseInt(jumlahInput.value) || 1;
                    if (val > 1) jumlahInput.value = val - 1;
                    jumlahInput.dispatchEvent(new Event('input'));
                });
                btnPlus.addEventListener('click', function() {
                    let val = parseInt(jumlahInput.value) || 1;
                    let max = parseInt(jumlahInput.max) || 1;
                    if (val < max) jumlahInput.value = val + 1;
                    jumlahInput.dispatchEvent(new Event('input'));
                });
            });
            hadiahInput.addEventListener('change', function() {
                btnTukar.disabled = !hadiahInput.value;
            });
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



 