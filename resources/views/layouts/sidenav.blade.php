<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
            <span>Admin</span>

        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if (request()->route()->getName() == 'datakaryawan.index') active @endif " aria-current="page"
                    href="{{ route('datakaryawan.index') }}">
                    <i class="bi bi-0-circle-fill"></i>
                    Data Karyawan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (request()->route()->getName() == 'datakaryawan.daftarabsensi') active @endif" href="#">

                    Daftar Absensi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (request()->route()->getName() == 'datakaryawan.persetujuancuti') active @endif" href="#">

                    Persetujuan Cuti
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (request()->route()->getName() == 'datakaryawan.penggajian') active @endif" href="#">

                    Penggajian
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (request()->route()->getName() == 'datakaryawan.rekrutmen') active @endif" href="#">

                    Rekrutmen
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Karyawan</span>

        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item ">
                <a class="nav-link @if (request()->route()->getName() == 'pengajuancuti.index') active @endif"
                    href="{{ route('pengajuancuti.index') }}">

                    Pengajuan Cuti
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link @if (request()->route()->getName() == 'datakaryawan.riwayatgaji') active @endif" href="#">

                    Riwayat Gaji
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (request()->route()->getName() == 'datakaryawan.absensi') active @endif" href="#">

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
                    
                    Info
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">

                    Sign Out
                </a>
            </li>
        </ul>
    </div>
</nav>
