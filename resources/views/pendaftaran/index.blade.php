@extends('layout.app')

@section('title', 'Pendaftaran Kegiatan')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Pendaftaran Kegiatan</h1>
            <p class="page-sub">Daftar menggunakan akun {{ $user->email }}.</p>
        </div>
    </div>

    <div class="panel mb-3">
        <div class="panel-head">Pilih kegiatan</div>
        <div class="panel-body">
            <form action="{{ route('pendaftaran.store') }}" method="POST" class="row g-3 align-items-end">
                @csrf
                <div class="col-md-9">
                    <label for="event_id" class="form-label">Kegiatan</label>
                    <select name="event_id" id="event_id" class="form-select" required>
                        <option value="">-- Pilih kegiatan --</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" @selected(old('event_id') == $event->id)>
                                {{ $event->judul }} ({{ $event->tanggal->translatedFormat('d M Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">Kegiatan yang sudah didaftarkan</div>
        <div class="table-responsive">
            <table class="table table-ev mb-0">
                <thead>
                    <tr>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr>
                            <td class="fw-semibold">{{ $registration->event->judul }}</td>
                            <td>{{ $registration->event->tanggal->translatedFormat('d M Y') }}</td>
                            <td>{{ $registration->event->lokasi ?: '-' }}</td>
                            <td>
                                <span class="badge {{ $registration->status === 'dikonfirmasi' ? 'bg-success' : ($registration->status === 'dibatalkan' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Kamu belum mendaftar kegiatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection