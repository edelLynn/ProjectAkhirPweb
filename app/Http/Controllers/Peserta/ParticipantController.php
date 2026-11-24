<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Peserta\ParticipantRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    // Daftar peserta + pencarian (?q=...) + pagination
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $participants = User::mahasiswa()
            ->withCount('registrations')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('name', 'like', "%{$q}%")
                      ->orWhere('nim', 'like', "%{$q}%")
                      ->orWhere('prodi', 'like', "%{$q}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString(); // supaya ?q= tidak hilang saat pindah halaman

        return view('peserta.index', compact('participants', 'q'));
    }

    public function create()
    {
        return view('peserta.create');
    }

    public function store(ParticipantRequest $request): RedirectResponse
    {
        // Data sudah lolos validasi. Role dipaksa mahasiswa (tidak dari form).
        $participant = User::create($request->validated() + ['role' => 'mahasiswa']);

        return redirect()->route('participants.index')
            ->with('success', "Peserta {$participant->name} berhasil ditambahkan.");
    }

    public function show(string $id)
    {
        $participant = $this->findParticipant($id)->load('registrations.event');

        return view('peserta.show', compact('participant'));
    }

    public function edit(string $id)
    {
        $participant = $this->findParticipant($id);

        return view('peserta.edit', compact('participant'));
    }

    public function update(ParticipantRequest $request, string $id): RedirectResponse
    {
        $participant = $this->findParticipant($id);
        $participant->update($request->validated()); // tidak ada password di sini

        return redirect()->route('participants.index')
            ->with('success', "Data {$participant->name} berhasil diperbarui.");
    }

    public function destroy(string $id): RedirectResponse
    {
        $participant = $this->findParticipant($id);
        $participant->delete(); // pendaftarannya ikut terhapus (cascadeOnDelete)

        return redirect()->route('participants.index')
            ->with('success', "Peserta {$participant->name} berhasil dihapus.");
    }

    // Hanya mencari di antara mahasiswa, jadi akun admin tidak bisa diubah/dihapus dari sini
    private function findParticipant(string $id): User
    {
        return User::mahasiswa()->findOrFail($id);
    }
}
