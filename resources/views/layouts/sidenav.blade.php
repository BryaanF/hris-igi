<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
            <span>Admin</span>

        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if (request()->route()->getName() == 'adminone.index') active @endif " aria-current="page"
                    href="{{ route('datakaryawan.index') }}">
                    <span data-feather="home"></span>
                    Data Karyawan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#">
                    <span data-feather="file"></span>
                    Daftar Absensi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="shopping-cart"></span>
                    Persetujuan Cuti
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    Penggajian
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="bar-chart-2"></span>
                    Rekrutmen
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Karyawan</span>

        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Pengajuan Cuti
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Riwayat Gaji
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Absensi
                </a>
            </li>
        </ul>
        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted d-md-none">
            <span>Profile</span>

        </h6>
        <ul class="nav flex-column mb-2 d-md-none">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Info
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Sign Out
                </a>
            </li>
        </ul>
    </div>
</nav>
