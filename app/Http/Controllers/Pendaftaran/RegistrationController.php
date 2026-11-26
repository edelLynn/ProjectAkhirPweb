<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pendaftaran\StoreRegistrationRequest;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('pendaftaran.index', [
            'user' => $user,
            'events' => Event::with('category')
                ->whereDate('tanggal', '>=', today())
                ->orderBy('tanggal')
                ->orderBy('waktu_mulai')
                ->get(),
            'registrations' => $user->registrations()
                ->with('event')
                ->latest('tanggal_daftar')
                ->get(),
        ]);
    }

    public function store(StoreRegistrationRequest $request): RedirectResponse
    {
        $user = $request->user();
        $event = Event::findOrFail($request->integer('event_id'));

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
}