@extends('layout.app')

@section('title', 'Ganti Password')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Ganti password</h1>
            <p class="page-sub">Masukkan password saat ini, lalu password baru.</p>
        </div>
    </div>

    <div class="panel" style="max-width: 32rem;">
        <div class="panel-body">
            <form method="POST" action="{{ route('password.update') }}" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Password saat ini</label>
                    <input type="password" id="current_password" name="current_password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           autocomplete="current-password" required>
                    @error('current_password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password baru</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               autocomplete="new-password" aria-describedby="password-hint" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password"
                                data-target="#password" aria-pressed="false" aria-label="Tampilkan password">
                            <i class="bi bi-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div id="password-hint" class="form-text">Minimal 8 karakter.</div>
                    @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi password baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="form-control" autocomplete="new-password" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan password</button>
            </form>
        </div>
    </div>
@endsection
