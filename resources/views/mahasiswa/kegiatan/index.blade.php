@extends('layout.app')

@section('title', 'Kegiatan Mahasiswa')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Kegiatan Mahasiswa</h1>
            <p class="page-sub">Temukan kegiatan dan daftar secara mandiri.</p>
        </div>
    </div>

    <div class="row g-3">
        @forelse ($events as $event)
            @php($status = $registrations[$event->id] ?? null)
            <div class="col-md-6 col-xl-4">
                <article class="panel h-100">
                    <div class="panel-body">
                        <span class="badge bg-light text-dark mb-2">{{ $event->category?->nama ?? 'Umum' }}</span>
                        <h2 class="h5">{{ $event->judul }}</h2>
                        <p class="text-muted small mb-2">{{ $event->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                        <dl class="small mb-3">
                            <dt>Tanggal</dt>
                            <dd>{{ $event->tanggal->translatedFormat('d M Y') }}</dd>
                            <dt>Lokasi</dt>
                            <dd>{{ $event->lokasi ?: '-' }}</dd>
                        </dl>

                        @if ($status)
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge {{ $status === 'dikonfirmasi' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ ucfirst($status) }}
                                </span>
                                @if ($status === 'terdaftar')
                                    {{-- baru --}}
                                    <form method="POST" action="{{ route('mahasiswa.kegiatan.destroy', $event) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Batalkan</button>
                                    </form>
                                @endif
                            </div>
                        @else
                            {{-- baru --}}
                            <form method="POST" action="{{ route('mahasiswa.kegiatan.store', $event) }}">
                                @csrf
                                <button class="btn btn-primary w-100">Daftar Kegiatan</button>
                            </form>
                        @endif
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12">
                <div class="panel panel-body text-center text-muted">Belum ada kegiatan mendatang.</div>
            </div>
        @endforelse
    </div>
@endsection
