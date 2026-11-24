<?php

namespace App\Http\Controllers\Kehadiran;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kehadiran\SimpanKehadiranRequest;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\Registration;

class AttendanceController extends Controller
{
    public function daftarKegiatan()
    {
        $events = Event::withCount("registrations")
            ->orderByDesc("tanggal")
            ->get();
        return view("kehadiran.kegiatan", compact("events"));
    }

    public function daftarPeserta(Event $event)
    {
        $registrations = $event->registrations()
            ->with(['user', 'attendance'])
            ->get()
            ->sortBy('user.name');

        return view('kehadiran.peserta', compact('event', 'registrations'));
    }

    public function simpan(
        SimpanKehadiranRequest $request,
        Registration $registration,
    ) {
        Attendance::updateOrCreate(
            ["registration_id" => $registration->id],
            [
                "status" => $request->status,
                "catatan" => $request->catatan,
                "waktu_dicatat" => now(),
            ],
        );
        return back()->with("sukses", "Kehadiran berhasil disimpan.");
    }
}
