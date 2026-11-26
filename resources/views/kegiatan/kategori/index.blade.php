
@extends('layout.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen Kategori</h2>

        {{-- baru --}}
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">
            + Tambah Kategori
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->nama }}</td>
                                <td>{{ $category->deskripsi ?? '-' }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('kategori.edit', $category->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('kategori.destroy', $category->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                                <td colspan="4" class="text-center">
                                    Belum ada kategori.
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
