<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        @if (auth()->user()->role == 'Administrator')
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
                <span>Administrator</span>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link @if (request()->route()->getName() == 'datakaryawan.index') active @endif " aria-current="page"
                        href="{{ route('datakaryawan.index') }}">
                        <i class="bi bi-person-lines-fill"></i>
                        Data Karyawan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (request()->route()->getName() == 'daftarabsensi.index') active @endif"
                        href="{{ route('daftarabsensi.index') }}">
                        <i class="bi bi-calendar-week"></i>
                        Daftar Absensi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (request()->route()->getName() == 'persetujuancuti.index') active @endif"
                        href="{{ route('persetujuancuti.index') }}">
                        <i class="bi bi-hand-thumbs-up"></i>
                        Persetujuan Cuti
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (request()->route()->getName() == 'penggajian.index') active @endif"
                        href="{{ route('penggajian.index') }}">
                        <i class="bi bi-cash-coin"></i>
                        Penggajian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (request()->route()->getName() == 'rekrutmen.index') active @endif"
                        href="{{ route('rekrutmen.index') }}">
                        <i class="bi bi-file-earmark-person"></i>
                        Rekrutmen
                    </a>
                </li>
            </ul>
        @endif

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
            <span>Karyawan</span>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item ">
                <a class="nav-link @if (request()->route()->getName() == 'pengajuancuti.index') active @endif"
                    href="{{ route('pengajuancuti.index') }}">
                    <i class="bi bi-person-raised-hand"></i>
                    Pengajuan Cuti
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link @if (request()->route()->getName() == 'riwayatgaji.index') active @endif"
                    href="{{ route('riwayatgaji.index') }}">
                    <i class="bi bi-cash-coin"></i>
                    Riwayat Gaji
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (request()->route()->getName() == 'absensi.index') active @endif" href="{{ route('absensi.index') }}">
                    <i class="bi bi-calendar-check"></i>
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
                <a class="nav-link" href="{{ route('profil.index') }}">
                    <i class="bi bi-person-badge"></i>
                    Profile Information
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    <button class="nav-link">
                        <i class="bi bi-box-arrow-right"></i>
                        Log Out
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
