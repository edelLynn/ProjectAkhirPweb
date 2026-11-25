@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    @php $user = auth()->user(); @endphp

    <div class="page-head">
        <div>
            <h1 class="page-title">Halo, {{ $user->name }}</h1>
            <p class="page-sub">Selamat datang di Eventra.</p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-4">
            <div class="panel">
                <h2 class="panel-head">Data diri</h2>
                <div class="panel-body">
                    <dl class="detail-list">
                        <dt>NIM</dt><dd>{{ $user->nim ?? '-' }}</dd>
                        <dt>Email</dt><dd>{{ $user->email }}</dd>
                        <dt>Prodi</dt><dd>{{ $user->prodi ?? '-' }}</dd>
                        <dt>No HP</dt><dd>{{ $user->no_hp ?? '-' }}</dd>
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
                                <th scope="col">Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($registrations as $r)
                                <tr>
                                    <td class="fw-semibold">{{ $r->event->judul }}</td>
                                    <td class="text-nowrap">{{ $r->event->tanggal->translatedFormat('d M Y') }}</td>
                                    <td>{{ $r->event->lokasi ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        Kamu belum mengikuti kegiatan apa pun.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
