@extends('layout.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Kehadiran Kegiatan</h1>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-sm">
                <tr>
                    <th class="p-3">Kegiatan</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Pendaftar</th>
                    <th class="p-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr class="border-t">
                        <td class="p-3">{{ $event->judul }}</td>
                        <td class="p-3">{{ $event->tanggal->format('d M Y') }}</td>
                        <td class="p-3">{{ $event->registrations_count }}</td>
                        <td class="p-3">
                            <a href="{{ route('kehadiran.peserta', $event) }}"
                               class="text-blue-600 hover:underline">Catat kehadiran</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3 text-center text-gray-500">Belum ada kegiatan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
