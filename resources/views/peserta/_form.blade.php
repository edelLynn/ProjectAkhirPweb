{{-- Form dipakai bersama oleh create & edit.
     Variabel: $action (URL), $participant (User atau null) --}}
@php $isEdit = $participant !== null; @endphp

<form method="POST" action="{{ $action }}" novalidate>
    @csrf
    @if ($isEdit) @method('PUT') @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Nama lengkap <span class="text-danger" aria-hidden="true">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $participant?->name) }}"
                   class="form-control @error('name') is-invalid @enderror" maxlength="100" required>
            @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email <span class="text-danger" aria-hidden="true">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email', $participant?->email) }}"
                   class="form-control @error('email') is-invalid @enderror" maxlength="100" required>
            @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="nim" class="form-label">NIM <span class="text-danger" aria-hidden="true">*</span></label>
            <input type="text" id="nim" name="nim" value="{{ old('nim', $participant?->nim) }}"
                   class="form-control digits-only @error('nim') is-invalid @enderror"
                   inputmode="numeric" maxlength="12" aria-describedby="nim-hint" required>
            <div id="nim-hint" class="form-text">12 digit angka.</div>
            @error('nim') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="prodi" class="form-label">Program studi</label>
            <input type="text" id="prodi" name="prodi" value="{{ old('prodi', $participant?->prodi) }}"
                   class="form-control @error('prodi') is-invalid @enderror" maxlength="100">
            @error('prodi') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $participant?->no_hp) }}"
                   class="form-control digits-only @error('no_hp') is-invalid @enderror"
                   inputmode="numeric" maxlength="15">
            @error('no_hp') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
    </div>

    @unless ($isEdit)
        <hr class="my-4">

        <div class="row g-3">
            <div class="col-md-6">
                <label for="password" class="form-label">Password awal <span class="text-danger" aria-hidden="true">*</span></label>
                <div class="input-group">
                    <input type="password" id="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           autocomplete="new-password" aria-describedby="password-hint" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password"
                            data-target="#password" aria-pressed="false" aria-label="Tampilkan password">
                        <i class="bi bi-eye" aria-hidden="true"></i>
                    </button>
                </div>
                <div id="password-hint" class="form-text">
                    Minimal 8 karakter. Setelah akun dibuat, hanya mahasiswa yang dapat mengubahnya.
                </div>
                @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Konfirmasi password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-control" autocomplete="new-password">
            </div>
        </div>
    @endunless

    <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Simpan perubahan' : 'Simpan peserta' }}</button>
        <a href="{{ route('participants.index') }}" class="btn btn-light">Batal</a>
    </div>
</form>
