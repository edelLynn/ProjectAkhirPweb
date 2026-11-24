<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return view('peserta.dashboard-admin', [
                'totalPeserta'     => User::mahasiswa()->count(),
                'totalKegiatan'    => Event::count(),
                'totalPendaftaran' => Registration::count(),
                'pesertaTerbaru'   => User::mahasiswa()->latest('id')->take(5)->get(),
            ]);
        }

        return view('peserta.dashboard-mahasiswa', [
            'registrations' => $user->registrations()
                ->with('event')
                ->latest('tanggal_daftar')
                ->get(),
        ]);
    }
}
