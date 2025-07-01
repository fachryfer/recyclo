@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('asset/library/bootstrap-social/bootstrap-social.css') }}">
    <style>
        /* Ubah background halaman login menjadi hijau */
        .wrapper-login {
            background-color: #44bb5f; /* Hijau bootstrap */
        }
        /* Jika ingin agar container-login juga memiliki background hijau atau transparan */
        .container-login {
            background-color: transparent; /* atau bisa diatur sesuai kebutuhan */
        }
        .login-info {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: white;
        }
        .login-info p {
            margin-bottom: 5px;
            font-size: 14px;
        }
        /* Tambahan: warna teks input username & password */
        .form-control[type="username"],
        .form-control[type="password"] {
            color: #44bb5f;
        }
        .form-control:focus {
            border-color: #44bb5f;
            box-shadow: 0 0 0 0.2rem rgba(68, 187, 95, 0.15);
        }
        /* Warna label input */
        .form-floating > label,
        .form-floating-custom > label,
        .form-label,
        label[for="username"],
        label[for="password"] {
            color: #44bb5f !important;
        }
        /* Warna button masuk */
        .btn-primary.w-100 {
            background-color: #44bb5f !important;
            border-color: #44bb5f !important;
        }
        .btn-primary.w-100:hover, .btn-primary.w-100:focus {
            background-color: #36994a !important;
            border-color: #36994a !important;
        }
    </style>
@endpush

@section('main')
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn">
            <div class="text-center mb-3">
                <img src="{{ asset('assets/img/logo/logo-recycloV2.png') }}" alt="Logo Bank Sampah RECYCLO" style="max-width: 120px;">
            </div>
            <h3 class="text-center">Login Bank Sampah RECYCLO</h3>
            
            

            <div class="login-form">
                <div class="form-sub">
                    <form method="POST" action="{{ route('login.post') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-floating form-floating-custom mb-3">
                            <input id="username" type="username" class="form-control" name="username" tabindex="1"
                                required autofocus>
                            <label for="username">Username</label>
                        </div>
                        <div class="invalid-feedback">
                            Silakan isi username Anda
                        </div>
                        <div class="form-floating form-floating-custom mb-3">
                            <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                required>
                            <label for="password">Password</label>
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Mohon isi kata sandi Anda
                        </div>
                </div>
                <div class="form-action mb-3">
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </div>
                <center><br><p>Belum Punya Akun? <a href="{{ url('/#customer-service') }}" class="scroll-to-cs" title="Daftar Sekarang">Daftar Sekarang</a></p></center>
            </div>
        </div>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script>
        // Toggle password visibility
        document.querySelector('.show-password').addEventListener('click', function() {
            const passwordInput = document.querySelector('#password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('icon-eye');
            this.querySelector('i').classList.toggle('icon-eye-slash');
        });

        // Scroll smooth jika dari login ke #customer-service
        document.addEventListener('DOMContentLoaded', function() {
            if(window.location.hash === '#customer-service') {
                const el = document.getElementById('customer-service');
                if(el) {
                    el.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    </script>
@endpush
