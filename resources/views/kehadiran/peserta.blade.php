@extends('layout.app')

@section('content')
    <a href="{{ route('kehadiran.kegiatan') }}" class="text-blue-600 hover:underline text-sm">&larr; Kembali</a>
    <h1 class="text-2xl font-bold mt-2">{{ $event->judul }}</h1>
    <p class="text-gray-500 mb-4">{{ $event->tanggal->format('d M Y') }} &middot; {{ $event->lokasi }}</p>

    @if (session('sukses'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('sukses') }}</div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            @foreach ($errors->all() as $pesan)
                <div>{{ $pesan }}</div>
            @endforeach
        </div>
    @endif

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm">
                <tr>
                    <th class="p-3">Nama</th>
                    <th class="p-3">NIM</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Catatan</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($registrations as $registration)
                    <tr class="border-t">
                        <form method="POST" action="{{ route('kehadiran.simpan', $registration) }}">
                            @csrf
                            <td class="p-3">{{ $registration->user->name }}</td>
                            <td class="p-3">{{ $registration->user->nim }}</td>
                            <td class="p-3">
                                <select name="status" class="border rounded p-1">
                                    @foreach (['hadir', 'izin', 'alpa'] as $status)
                                        <option value="{{ $status }}"
                                            @selected($registration->attendance?->status === $status)>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="p-3">
                                <input type="text" name="catatan"
                                       value="{{ $registration->attendance?->catatan }}"
                                       class="border rounded p-1 w-full">
                            </td>
                            <td class="p-3">
                                <button type="submit"
                                        class="bg-blue-600 text-white px-3 py-1 rounded">Simpan</button>
                            </td>
                        </form>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">Belum ada peserta terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
