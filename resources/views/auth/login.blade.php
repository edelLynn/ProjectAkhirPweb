@extends('layout.guest')

@section('title', 'Masuk')

@section('content')
    <div class="text-center mb-4">
        <span class="brand fs-4">
            <span class="brand-mark"><i class="bi bi-calendar-event" aria-hidden="true"></i></span>Eventra
        </span>
        <p class="text-muted mt-2 mb-0">Sistem Informasi Manajemen Event Kampus</p>
    </div>

    <div class="panel">
        <div class="panel-body p-4">
            <h1 class="fs-5 fw-bold mb-4">Masuk ke akun</h1>

            <form method="POST" action="{{ route('login.store') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           autocomplete="username" autofocus required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               autocomplete="current-password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password"
                                data-target="#password" aria-pressed="false" aria-label="Tampilkan password">
                            <i class="bi bi-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
        </div>
    </div>

    <p class="text-center text-muted small mt-3">Akun mahasiswa dibuat oleh admin / panitia.</p>
@endsection
