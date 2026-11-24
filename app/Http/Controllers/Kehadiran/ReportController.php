<?php

namespace App\Http\Controllers\Kehadiran;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function tampilkan()
    {
        $events = Event::withCount('registrations')->withCount([
            'registrations as hadir_count' => fn ($query) => $query->whereHas
            ('attendance', fn ($attendance) => $attendance->where('status', 'hadir')),

            'registrations as izin_count' => fn ($query) => $query->whereHas
            ('attendance', fn ($attendance) => $attendance->where('status', 'izin')),

            'registrations as alpa_count' => fn ($query) =>$query->whereHas
            ('attendance', fn ($attendance) =>$attendance->where('status', 'alpa')),
        ])->orderByDesc('tanggal')->get();
        return view('kehadiran.laporan', compact('events'));
    }
}
