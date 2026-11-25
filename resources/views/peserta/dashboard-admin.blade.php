@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Dashboard</h1>
            <p class="page-sub">Ringkasan data Eventra.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-4">
            <div class="panel stat">
                <span class="stat-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                <div>
                    <div class="stat-label">Peserta</div>
                    <div class="stat-value">{{ $totalPeserta }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel stat">
                <span class="stat-icon"><i class="bi bi-calendar-event" aria-hidden="true"></i></span>
                <div>
                    <div class="stat-label">Kegiatan</div>
                    <div class="stat-value">{{ $totalKegiatan }}</div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel stat">
                <span class="stat-icon"><i class="bi bi-clipboard-check" aria-hidden="true"></i></span>
                <div>
                    <div class="stat-label">Pendaftaran</div>
                    <div class="stat-value">{{ $totalPendaftaran }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <h2 class="panel-head">Peserta terbaru</h2>
        <div class="table-responsive">
            <table class="table table-ev">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Prodi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pesertaTerbaru as $p)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $p->name }}</div>
                                <div class="small text-muted">{{ $p->email }}</div>
                            </td>
                            <td>{{ $p->nim }}</td>
                            <td>{{ $p->prodi ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center text-muted py-4">Belum ada peserta.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="panel-foot">
            <a href="{{ route('participants.index') }}">Lihat semua peserta</a>
        </div>
    </div>
@endsection
