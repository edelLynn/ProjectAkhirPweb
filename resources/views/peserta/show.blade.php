@extends('layouts.app')

@section('title', $participant->name)

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">{{ $participant->name }}</h1>
            <p class="page-sub">Detail peserta</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('participants.index') }}" class="btn btn-light">Kembali</a>
            <a href="{{ route('participants.edit', $participant->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil" aria-hidden="true"></i> Ubah
            </a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-4">
            <div class="panel">
                <h2 class="panel-head">Data diri</h2>
                <div class="panel-body">
                    <dl class="detail-list">
                        <dt>NIM</dt><dd>{{ $participant->nim }}</dd>
                        <dt>Email</dt><dd>{{ $participant->email }}</dd>
                        <dt>Prodi</dt><dd>{{ $participant->prodi ?? '-' }}</dd>
                        <dt>No HP</dt><dd>{{ $participant->no_hp ?? '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="panel">
                <h2 class="panel-head">Kegiatan yang diikuti</h2>
                <div class="table-responsive">
                    <table class="table table-ev">
                        <thead>
                            <tr>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Terdaftar pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($participant->registrations as $r)
                                <tr>
                                    <td class="fw-semibold">{{ $r->event->judul }}</td>
                                    <td class="text-nowrap">{{ $r->event->tanggal->translatedFormat('d M Y') }}</td>
                                    <td class="text-nowrap">{{ $r->tanggal_daftar->translatedFormat('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum mengikuti kegiatan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
