@extends('layout.app')

@section('title', 'Peserta')

@section('content')
    <div class="page-head">
        <div>
            <h1 class="page-title">Peserta</h1>
            <p class="page-sub">Kelola akun mahasiswa yang dapat mengikuti kegiatan.</p>
        </div>
        <a href="{{ route('participants.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg" aria-hidden="true"></i> Tambah peserta
        </a>
    </div>

    <div class="panel">
        {{-- Pencarian: form GET biasa, hasilnya dari query di ParticipantController@index --}}
        <div class="panel-body border-bottom">
            <form method="GET" action="{{ route('participants.index') }}" role="search" class="d-flex flex-wrap gap-2">
                <label for="q" class="visually-hidden">Cari peserta</label>
                <div class="input-group" style="max-width: 28rem;">
                    <input type="search" id="q" name="q" value="{{ $q }}" maxlength="100"
                           class="form-control" placeholder="Cari nama, NIM, atau prodi">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
                @if ($q !== '')
                    <a href="{{ route('participants.index') }}" class="btn btn-link">Reset</a>
                @endif
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-ev">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Prodi</th>
                        <th scope="col" class="text-center">Kegiatan</th>
                        <th scope="col" class="text-end"><span class="visually-hidden">Aksi</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($participants as $p)
                        <tr>
                            <td>{{ $participants->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="fw-semibold">{{ $p->name }}</div>
                                <div class="small text-muted">{{ $p->email }}</div>
                            </td>
                            <td>{{ $p->nim }}</td>
                            <td>{{ $p->prodi ?? '-' }}</td>
                            <td class="text-center"><span class="badge-soft">{{ $p->registrations_count }}</span></td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('participants.show', $p->id) }}" class="btn-icon"
                                   aria-label="Lihat detail {{ $p->name }}" title="Detail">
                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('participants.edit', $p->id) }}" class="btn-icon"
                                   aria-label="Ubah {{ $p->name }}" title="Ubah">
                                    <i class="bi bi-pencil" aria-hidden="true"></i>
                                </a>
                                <button type="button" class="btn-icon is-danger btn-delete"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-action="{{ route('participants.destroy', $p->id) }}"
                                        data-name="{{ $p->name }}"
                                        data-count="{{ $p->registrations_count }}"
                                        aria-label="Hapus {{ $p->name }}" title="Hapus">
                                    <i class="bi bi-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                @if ($q !== '')
                                    Tidak ada peserta yang cocok dengan “{{ $q }}”.
                                @else
                                    Belum ada peserta. Klik “Tambah peserta” untuk membuat akun pertama.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($participants->total() > 0)
            <div class="panel-foot pager d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span class="small text-muted">
                    Menampilkan {{ $participants->firstItem() }}–{{ $participants->lastItem() }}
                    dari {{ $participants->total() }} peserta
                </span>
                {{ $participants->links() }}
            </div>
        @endif
    </div>

    {{-- Modal konfirmasi hapus (isinya diisi oleh jQuery di public/js/eventra.js) --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="deleteModalLabel">Hapus peserta?</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p>Akun <strong id="deleteName"></strong> akan dihapus permanen.</p>
                        <div id="deleteWarning" class="alert alert-warning small mb-0 d-none" role="alert"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
