@php $user = auth()->user(); @endphp

<aside class="sidebar">
    <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="sidebarMenu" aria-label="Menu navigasi">
        <div class="offcanvas-body">

            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}" class="brand">
                    <span class="brand-mark"><i class="bi bi-calendar-event" aria-hidden="true"></i></span>Eventra
                </a>
                <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas"
                        data-bs-target="#sidebarMenu" aria-label="Tutup menu"></button>
            </div>

            <nav aria-label="Menu utama">
                <a href="{{ route('dashboard') }}"
                   class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   @if (request()->routeIs('dashboard')) aria-current="page" @endif>
                    <i class="bi bi-grid" aria-hidden="true"></i> Dashboard
                </a>

                @if ($user->role === 'admin')
                    <a href="{{ route('participants.index') }}"
                       class="side-link {{ request()->routeIs('participants.*') ? 'active' : '' }}"
                       @if (request()->routeIs('participants.*')) aria-current="page" @endif>
                        <i class="bi bi-people" aria-hidden="true"></i> Peserta
                    </a>
                @endif

                {{-- Menu modul lain: muncul otomatis kalau route-nya sudah ada.
                     Sesuaikan nama route dengan milik masing-masing anggota. --}}
                @if (Route::has('events.index'))
                    <a href="{{ route('events.index') }}"
                       class="side-link {{ request()->routeIs('events.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-event" aria-hidden="true"></i> Kegiatan
                    </a>
                @endif
                @if ($user->role === 'admin' && Route::has('registrations.index'))
                    <a href="{{ route('registrations.index') }}"
                       class="side-link {{ request()->routeIs('registrations.*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-check" aria-hidden="true"></i> Pendaftaran
                    </a>
                @endif
                @if ($user->role === 'admin' && Route::has('kehadiran.kegiatan'))
                    <a href="{{ route('kehadiran.kegiatan') }}"
                       class="side-link {{ request()->routeIs('kehadiran.*') ? 'active' : '' }}">
                        <i class="bi bi-person-check" aria-hidden="true"></i> Kehadiran
                    </a>
                @endif
                @if ($user->role === 'admin' && Route::has('kehadiran.laporan'))
                    <a href="{{ route('kehadiran.laporan') }}"
                       class="side-link {{ request()->routeIs('kehadiran.laporan') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-bar-graph" aria-hidden="true"></i> Laporan
                    </a>
                @endif
            </nav>

            <div class="sidebar-user">
                <div class="px-2 mb-2">
                    <div class="name">{{ $user->name }}</div>
                    <div class="role">{{ $user->role === 'admin' ? 'Admin / Panitia' : 'Mahasiswa' }}</div>
                </div>
                <a href="{{ route('password.edit') }}"
                   class="side-link {{ request()->routeIs('password.*') ? 'active' : '' }}">
                    <i class="bi bi-key" aria-hidden="true"></i> Ganti password
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="side-link w-100 border-0 bg-transparent text-start">
                        <i class="bi bi-box-arrow-right" aria-hidden="true"></i> Keluar
                    </button>
                </form>
            </div>

        </div>
    </div>
</aside>
