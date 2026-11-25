@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Laporan Kehadiran</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Total pendaftar</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Alpa</th>
                    <th>Belum dicatat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td>{{ $event->judul }}</td>
                        <td>{{ $event->tanggal }}</td>
                        <td>{{ $event->registrations_count }}</td>
                        <td>{{ $event->hadir_count }}</td>
                        <td>{{ $event->izin_count }}</td>
                        <td>{{ $event->alpa_count }}</td>
                        <td>
                            {{ $event->registrations_count - $event->hadir_count - $event->izin_count - $event->alpa_count }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada kegiatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
