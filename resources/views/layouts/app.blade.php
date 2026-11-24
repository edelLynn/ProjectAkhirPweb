<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') · Eventra</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/eventra.css') }}" rel="stylesheet">
</head>
<body>
    <a class="visually-hidden-focusable" href="#konten">Lewati ke konten</a>

    {{-- Bilah atas: hanya tampil di layar kecil, untuk membuka menu --}}
    <header class="topbar d-lg-none">
        <button type="button" class="btn-icon" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-label="Buka menu">
            <i class="bi bi-list fs-4" aria-hidden="true"></i>
        </button>
        <span class="brand"><span class="brand-mark"><i class="bi bi-calendar-event" aria-hidden="true"></i></span>Eventra</span>
    </header>

    @include('layouts.sidebar')

    <div class="app-main">
        <main id="konten" class="content">
            @include('layouts.alerts')
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/eventra.js') }}"></script>
    @stack('scripts')
</body>
</html>
