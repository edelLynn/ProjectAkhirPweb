<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Kegiatan - EVENTRA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- 1. Form Pendaftaran Peserta ke Kegiatan -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h1 class="h5 mb-0 fw-semibold">Pendaftaran Peserta ke Kegiatan</h1>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('pendaftaran.store') }}" method="POST" class="row g-3 align-items-end">
                            @csrf
                            <div class="col-md-5">
                                <label for="user_id" class="form-label fw-medium">Pilih Peserta</label>
                                <select name="user_id" id="user_id" class="form-select" required>
                                    <option value="">-- Pilih Peserta --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label for="event_id" class="form-label fw-medium">Pilih Kegiatan</label>
                                <select name="event_id" id="event_id" class="form-select" required>
                                    <option value="">-- Pilih Kegiatan --</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                            {{ $event->judul }} ({{ $event->tanggal }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 d-grid">
                                <button type="submit" class="btn btn-primary">Daftarkan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- 2 & 3. Daftar Pendaftar & Pengelolaan Status -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <h2 class="h6 mb-0 fw-semibold">Daftar Pendaftar</h2>

                        <form action="{{ route('pendaftaran.index') }}" method="GET" class="d-flex align-items-center gap-2">
                            <select name="event_id" class="form-select form-select-sm" style="width: 240px;" onchange="this.form.submit()">
                                <option value="">Semua Kegiatan</option>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}" {{ (string) $selectedEventId === (string) $event->id ? 'selected' : '' }}>
                                        {{ $event->judul }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($selectedEventId)
                                <a href="{{ route('pendaftaran.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                            @endif
                        </form>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="ps-4" style="width: 55px;">No</th>
                                        <th scope="col">Peserta</th>
                                        <th scope="col">Kegiatan</th>
                                        <th scope="col">Tanggal Daftar</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" style="width: 220px;">Kelola Status</th>
                                        <th scope="col" class="text-end pe-4" style="width: 110px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($registrations as $index => $registration)
                                        @php
                                            $statusNow = $registration->status ?? 'terdaftar';
                                            $badgeClass = match($statusNow) {
                                                'dikonfirmasi' => 'bg-success',
                                                'dibatalkan' => 'bg-danger',
                                                default => 'bg-warning text-dark',
                                            };
                                        @endphp
                                        <tr>
                                            <td class="ps-4">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="fw-medium">{{ $registration->peserta_nama ?? '-' }}</div>
                                                <small class="text-muted">{{ $registration->peserta_email ?? '' }}</small>
                                            </td>
                                            <td>
                                                <div class="fw-medium">{{ $registration->event_judul ?? '-' }}</div>
                                                <small class="text-muted">{{ $registration->event_tanggal ?? '' }} {{ $registration->event_lokasi ? '• ' . $registration->event_lokasi : '' }}</small>
                                            </td>
                                            <td>{{ $registration->tanggal_daftar }}</td>
                                            <td>
                                                <span class="badge {{ $badgeClass }}">{{ ucfirst($statusNow) }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('pendaftaran.updateStatus', $registration->id) }}" method="POST" class="d-flex gap-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-select form-select-sm">
                                                        <option value="terdaftar" {{ $statusNow === 'terdaftar' ? 'selected' : '' }}>Terdaftar</option>
                                                        <option value="dikonfirmasi" {{ $statusNow === 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                                                        <option value="dibatalkan" {{ $statusNow === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-sm btn-outline-primary">Simpan</button>
                                                </form>
                                            </td>
                                            <td class="text-end pe-4">
                                                <form action="{{ route('pendaftaran.destroy', $registration->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pendaftaran ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                Belum ada data pendaftaran.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>