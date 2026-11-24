<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Eventra')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ url('/') }}">Eventra</a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarEventra"
                    aria-controls="navbarEventra" aria-expanded="false"
                    aria-label="Buka navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarEventra">
                <ul class="navbar-nav me-auto">
                    @php
                        $menu = [
                            ['label' => 'Dashboard', 'route' => 'dashboard', 'active' => 'dashboard'],
                            ['label' => 'Kegiatan', 'route' => 'kegiatan.index', 'active' => 'kegiatan.*'],
                            ['label' => 'Peserta', 'route' => 'peserta.index', 'active' => 'peserta.*'],
                            ['label' => 'Pendaftaran', 'route' => 'pendaftaran.index', 'active' => 'pendaftaran.*'],
                            ['label' => 'Kehadiran', 'route' => 'kehadiran.kegiatan', 'active' => 'kehadiran.*'],
                            ['label' => 'Laporan', 'route' => 'laporan.tampilkan', 'active' => 'laporan.*'],
                        ];
                    @endphp

                    @foreach ($menu as $item)
                        @if (\Illuminate\Support\Facades\Route::has($item['route']))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs($item['active']) ? 'active' : '' }}"
                                   href="{{ route($item['route']) }}">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
