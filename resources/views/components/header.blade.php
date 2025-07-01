<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header">

            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/logo/logo-recycloV2.png') }}" alt="navbar brand" class="navbar-brand" height="60">
            </a>
            <button class="navbar-toggler sidenav-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="gg-menu-right"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->
    </div>
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg">

        <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form class="navbar-left navbar-form nav-search">
                            <div class="input-group">
                                <input type="text" placeholder="Search ..." class="form-control">
                            </div>
                        </form>
                    </ul>
                </li>
                <li class="nav-item topbar-user hidden-caret">
                    <a class="profile-pic" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ asset('assets/img/mlane.jpg') }}" alt="..."
                                class="avatar-img rounded-circle">
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Vamoss,</span> <span class="fw-bold">{{ Auth::user()->nama }}</span>
                        </span>
                    </a>
                    {{-- <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg"><img src="{{ asset('assets/img/profile.jpg') }}"
                                            alt="image profile" class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->nama }}</h4>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Logout</a>
                            </li>
                        </div>
                    </ul> --}}
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
