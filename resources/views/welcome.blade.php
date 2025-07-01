<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Recyclo - Sistem Informasi Bank Sampah" />
    <meta name="author" content="Recyclo" />
    <title>Recyclo - Buat Bumi Menjadi Bersih</title>
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
            <img src="assets/img/logo/logo-recycloV2.png" alt="Recyclo Logo" style="height:40px;">
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
    <!-- New Navbar -->
    <nav class="navbar">
        <div class="navbar-container" style="display:flex;align-items:center;justify-content:space-between;max-width:1200px;margin:0 auto;padding:0 20px;">
            <div style="flex:0 0 auto;display:flex;align-items:center;">
                <button class="navbar-hamburger" id="sidebarOpen"><i class="bi bi-list"></i></button>
                <a href="#" class="navbar-logo">
                    <img src="assets/img/logo/logo-recycloV2.png" alt="Recyclo Logo" style="height:50px;vertical-align:middle;">
                </a>
            </div>
            <div class="navbar-menu" style="flex:1 1 0;display:flex;gap:30px;align-items:center;justify-content:center;text-align:center;">
                <a href="#" class="navbar-link">Cara kerja</a>
                <a href="#features" class="navbar-link">Fitur</a>
                <div class="dropdown">
                    <a href="#products" class="navbar-link">Produk</a>
                    <div class="dropdown-content">
                        <div class="dropdown-heading">Hadiah yang tersedia</div>
                        <a href="#products" class="dropdown-link">Voucher Belanja</a>
                        <a href="#products" class="dropdown-link">Saldo E-Wallet</a>
                        <a href="#products" class="dropdown-link">Pulsa & Paket Data</a>
                        <a href="#products" class="dropdown-link">Voucher Game</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#sampah" class="navbar-link">Sampah</a>
                    <div class="dropdown-content">
                        <div class="dropdown-heading">Jenis sampah yang bisa dijual</div>
                        @foreach(array_slice($sampahs->where('gambar','!=',null)->all(),0,6) as $sampah)
                            <a href="#sampah" class="dropdown-link">{{ $sampah->nama_sampah }}</a>
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
                    <div class="d-flex align-items-center me-3">
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
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                    <a href="#customer-service" class="btn btn-primary">Daftar</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="#">
        <div class="container">
            <div class="hero-flex">
                <div class="hero-content">
                    <h1 class="hero-title">Platform hadiah daur ulang <span class="animated-word">sampah</span></h1>
                    <p class="hero-subtitle">Dengan Recyclo, kelola sampahmu dan dapatkan poin yang bisa ditukarkan dengan beragam hadiah menarik. Mulai dari voucher belanja hingga saldo e-wallet untuk kebutuhanmu.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Mulai Sekarang</a>
                </div>
                <div class="hero-image">
                    <!-- Tambahkan gambar lain di bawah ini -->
                    <img src="assets/img/landingpage-recyclo.png" alt="Logo Recyclo" style="max-width: 600px; margin-top: 20px;" />
                </div>
            </div>
        </div>
    </section>

    <!-- Quote Section -->
    <section class="quote-section">
        <div class="container">
            <p class="quote-text">"Langkah pertama untuk masa depan cerah dimulai dengan menjaga bumi. Daur ulang sampahmu, kumpulkan poin, dan tukarkan dengan hadiah menarik!"</p>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="features">
        <div class="container">
            <h2 class="section-title">Fitur lengkap</h2>
            <p class="section-subtitle">Daur ulang sampah jadi lebih mudah dan bermanfaat</p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-recycle"></i>
                    </div>
                    <h3 class="feature-title">Setoran sampah variatif</h3>
                    <p class="feature-desc">Bisa menyetorkan berbagai jenis sampah daur ulang dari plastik, kertas, logam, hingga elektronik bekas untuk ditukarkan poin.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h3 class="feature-title">Lebih simple</h3>
                    <p class="feature-desc">Kamu cukup datang ke lokasi bank sampah, timbangkan sampahmu, dan dapatkan poin secara otomatis yang langsung masuk ke akun kamu.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-globe2"></i>
                    </div>
                    <h3 class="feature-title">Website dengan akun pribadi</h3>
                    <p class="feature-desc">Kamu juga mendapatkan akun pribadi untuk pantau poin dan menukarkannya dengan hadiah kapan saja. GRATIS!</p>
                </div>
            </div>

            <div class="features-grid" style="margin-top: 30px;">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-gear"></i>
                    </div>
                    <h3 class="feature-title">Atur penukaran poin</h3>
                    <p class="feature-desc">Cocok untuk kamu yang ingin mengumpulkan banyak poin sebelum menukarkannya dengan hadiah bernilai lebih besar.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-file-earmark-bar-graph"></i>
                    </div>
                    <h3 class="feature-title">Laporan yang lengkap</h3>
                    <p class="feature-desc">Semua aktivitas setoran sampah dan penukaran poin akan dicatat secara detail di sistem laporan yang lengkap.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section" id="products">
        <div class="container">
            <h2 class="section-title">Berbagai pilihan hadiah di Recyclo</h2>
            <p class="section-subtitle">Tukarkan poinmu dengan hadiah menarik</p>
            
            <div class="products-container">
                <div class="product-logo">
                    <img src="assets/img/products/reward-dana.png" alt="Dana" />
                </div>
                <div class="product-logo">
                    <img src="assets/img/products/reward-gopay.png" alt="Gopay" />
                </div>
                <div class="product-logo">
                    <img src="assets/img/products/reward-ovo.png" alt="OVO" />
                </div>
                <div class="product-logo">
                    <img src="assets/img/products/reward-shopeepay.png" alt="ShopeePay" />
                </div>
                <div class="product-logo">
                    <img src="assets/img/products/reward-indomaret.png" alt="Indomaret" />
                </div>
                <div class="product-logo">
                    <img src="assets/img/products/reward-alfamart.png" alt="Alfamart" />
                </div>
                <div class="product-logo">
                    <img src="assets/img/products/reward-telkomsel.png" alt="Telkomsel" />
                </div>
                <div class="product-logo">
                    <img src="assets/img/products/reward-xl.png" alt="XL" />
                </div>
            </div>
            
            <p style="margin-top: 20px; color: var(--secondary-text);">... dan masih banyak lagi.</p>
        </div>
    </section>

    <!-- Sampah Section -->
    <section class="products-section" id="sampah">
        <div class="container">
            <h2 class="section-title">Jenis Sampah yang Dapat Dijual</h2>
            <p class="section-subtitle">Berikut adalah jenis-jenis sampah yang dapat Anda jual di Bank Sampah Recyclo</p>
            
            <div class="sampah-container">
                @foreach($sampahs as $sampah)
                <div class="sampah-card">
                    <div class="sampah-image">
                        @if($sampah->gambar)
                            <img src="{{ asset('storage/sampah/'.$sampah->gambar) }}" alt="{{ $sampah->nama_sampah }}">
                        @else
                            <img src="{{ asset('assets/img/no-image.png') }}" alt="No Image">
                        @endif
                    </div>
                    <div class="sampah-info"  id="customer-service">
                        <h3>{{ $sampah->nama_sampah }}</h3>
                        <p class="price">Rp {{ number_format($sampah->harga_per_kg, 0, ',', '.') }}/kg</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="contact-info text-center mt-4">
                <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                    <div style="display: flex; align-items: center; gap: 10px; justify-content: center;">
                        <i class="bi bi-headset" style="font-size:2.2rem;color:#fff;"></i>
                        <span style="font-size: 1.5rem; font-weight: 700; color: #fff; letter-spacing: 1px;">Layanan Konsultasi & Penjualan Sampah</span>
                    </div>
                    <div style="font-size: 1.1rem; color: #e0ffe0; margin-bottom: 4px;">Siap membantu Anda dalam pembuatan akun, jual sampah, konsultasi harga, dan penjemputan!</div>
                    <a href="https://wa.me/6285275194592" target="_blank" rel="noopener" class="btn btn-success" style="font-size:1.3rem;padding:12px 36px;border-radius:30px;box-shadow:0 4px 16px rgba(46,139,87,0.15);display:inline-flex;align-items:center;gap:10px;">
                        <i class="bi bi-telephone-fill" style="font-size:1.5rem;"></i> WhatsApp Admin: <b>0852-7519-4592</b>
                    </a>
                    <div style="font-size: 0.95rem; color: #e0ffe0; margin-top: 6px;">Respon cepat setiap hari pukul 08.00 - 17.00 WIB</div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works Section -->
    <section class="marketplace-section" id="about">
        <div class="container">
            <div class="marketplace-flex">
                <div class="marketplace-image">
                    <img src="assets/img/filosofi-recycloV2.png" alt="Cara Kerja Recyclo" style="max-width: 650px; margin-top: 20px;" />
                </div>
                <div class="marketplace-content">
                    <h2 class="section-title">Daur ulang jadi lebih mudah</h2>
                    <p class="section-subtitle">Setorkan sampah, dapat poin, tukar hadiah</p>
                    
                    <div class="marketplace-steps">
                        <div class="step-item">
                            <div class="step-number"></div>
                            <div class="step-content">
                                <h3>Kumpulkan sampah daur ulang</h3>
                                <p>Pilah dan kumpulkan sampah daur ulang seperti plastik, kertas, logam, dan sampah elektronik dari rumahmu.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number"></div>
                            <div class="step-content">
                                <h3>Setorkan ke Bank Sampah Recyclo</h3>
                                <p>Bawa sampah daur ulangmu ke lokasi Bank Sampah Recyclo terdekat dan timbangkan sampahmu.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number"></div>
                            <div class="step-content">
                                <h3>Dapatkan poin Recyclo</h3>
                                <p>Setiap kg sampah akan dihargai dengan poin sesuai jenisnya yang akan masuk ke akun Recyclo-mu.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number"></div>
                            <div class="step-content">
                                <h3>Tukarkan poin dengan hadiah</h3>
                                <p>Poin yang sudah terkumpul bisa ditukarkan dengan berbagai hadiah menarik seperti voucher belanja, saldo e-wallet, dan paket data.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Mulai kampanye daur ulangmu sekarang</h2>
            <p class="cta-subtitle">Dan berikan kontribusimu untuk bumi yang lebih bersih sambil mendapatkan hadiah menarik!</p>
            
            <div class="cta-form">
                <input type="text" class="cta-input" placeholder="Nama Kamu" />
                <span style="line-height: 48px; color: var(--white);">.recyclo.com</span>
                <a href="#" class="btn btn-secondary">Daftar sekarang</a>
            </div>
        </div>
    </section>

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
        // Sidebar open/close logic
        const sidebar = document.getElementById('sidebarNav');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarOpen = document.getElementById('sidebarOpen');
        const sidebarClose = document.getElementById('sidebarClose');
        sidebarOpen.addEventListener('click', function() {
            sidebar.classList.add('active');
            sidebarOverlay.classList.add('active');
        });
        sidebarClose.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        });
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        });

        // Sidebar dropdown logic
        document.querySelectorAll('.sidebar-dropdown > .sidebar-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = link.parentElement;
                parent.classList.toggle('open');
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
