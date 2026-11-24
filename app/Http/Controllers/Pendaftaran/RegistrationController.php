<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $selectedEventId = $request->query('event_id');
        $authUserId = Auth::id();

        $events = DB::table('events')
            ->orderByDesc('id')
            ->get();

        $users = DB::table('users')
            ->orderBy('name')
            ->get();

        $registrations = DB::table('registrations')
            ->leftJoin('users', 'registrations.user_id', '=', 'users.id')
            ->leftJoin('events', 'registrations.event_id', '=', 'events.id')
            ->select(
                'registrations.id',
                'registrations.user_id',
                'registrations.event_id',
                'registrations.tanggal_daftar',
                'registrations.status',
                'users.name as peserta_nama',
                'users.email as peserta_email',
                'events.judul as event_judul',
                'events.tanggal as event_tanggal',
                'events.lokasi as event_lokasi'
            )
            ->when($selectedEventId, function ($query) use ($selectedEventId) {
                return $query->where('registrations.event_id', $selectedEventId);
            })
            ->orderByDesc('registrations.id')
            ->get();

        return view('pendaftaran.index', [
            'events' => $events,
            'users' => $users,
            'registrations' => $registrations,
            'selectedEventId' => $selectedEventId,
            'authUserId' => $authUserId,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'event_id' => ['required', 'integer', 'exists:events,id'],
        ]);

        // Prioritaskan user_id dari input (Use Case #8: Admin mendaftarkan peserta),
        // fallback ke Auth::id() (Use Case #4: Mahasiswa mendaftar sendiri)
        $userId = $validated['user_id'] ?? Auth::id();
        $eventId = $validated['event_id'];

        if (!$userId) {
            return redirect()
                ->route('pendaftaran.index')
                ->with('error', 'Pilih peserta terlebih dahulu atau login sebagai mahasiswa.');
        }

        // Mencegah pendaftaran ganda pada kegiatan yang sama
        $alreadyRegistered = DB::table('registrations')
            ->where('user_id', $userId)
            ->where('event_id', $eventId)
            ->exists();

        if ($alreadyRegistered) {
            return redirect()
                ->route('pendaftaran.index')
                ->with('error', 'Anda / peserta ini sudah terdaftar pada kegiatan yang sama.');
        }

        DB::table('registrations')->insert([
            'user_id' => $userId,
            'event_id' => $eventId,
            'tanggal_daftar' => now(),
            'status' => 'terdaftar',
        ]);

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Pendaftaran kegiatan berhasil disimpan.');
    }

    public function updateStatus(Request $request, int $registration): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:terdaftar,dikonfirmasi,dibatalkan'],
        ]);

        DB::table('registrations')
            ->where('id', $registration)
            ->update([
                'status' => $validated['status'],
            ]);

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy(int $registration): RedirectResponse
    {
        DB::table('registrations')
            ->where('id', $registration)
            ->delete();

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}