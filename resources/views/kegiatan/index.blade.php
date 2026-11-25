
@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen Kegiatan</h2>

        <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">
            + Tambah Kegiatan
        </a>
    </div>

    @if (session('sukses'))
        <div class="alert alert-success">
            {{ session('sukses') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul Kegiatan</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $event->judul }}</td>
                                <td>{{ $event->nama_kategori }}</td>
                                <td>{{ $event->tanggal }}</td>
                                <td>{{ $event->waktu_mulai ?? '-' }}</td>
                                <td>{{ $event->lokasi ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('kegiatan.edit', $event->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('kegiatan.destroy', $event->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Belum ada data kegiatan.
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
