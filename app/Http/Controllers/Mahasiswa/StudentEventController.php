<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

//baru
class StudentEventController extends Controller
{
    //baru
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('mahasiswa.kegiatan.index', [
            'events' => Event::with('category')
                ->whereDate('tanggal', '>=', today())
                ->orderBy('tanggal')
                ->orderBy('waktu_mulai')
                ->get(),
            'registrations' => $user->registrations()->pluck('status', 'event_id'),
        ]);
    }

    //baru
    public function store(Request $request, Event $event): RedirectResponse
    {
        $user = $request->user();

        //baru
        if ($event->tanggal->isBefore(today())) {
            return back()->with('error', 'Kegiatan yang sudah lewat tidak dapat didaftarkan.');
        }

        if (Registration::where('user_id', $user->id)->where('event_id', $event->id)->exists()) {
            return back()->with('error', 'Kamu sudah terdaftar pada kegiatan ini.');
        }

        Registration::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'tanggal_daftar' => now(),
            'status' => 'terdaftar',
        ]);

        return back()->with('success', 'Berhasil mendaftar kegiatan.');
    }

    //baru
    public function destroy(Request $request, Event $event): RedirectResponse
    {
        Registration::where('user_id', $request->user()->id)
            ->where('event_id', $event->id)
            ->where('status', 'terdaftar')
            ->delete();

        return back()->with('success', 'Pendaftaran berhasil dibatalkan.');
    }
}
