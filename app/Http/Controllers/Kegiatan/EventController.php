<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

//baru
class EventController extends Controller
{
    //baru
    public function index(): View
    {
        return view('kegiatan.index', [
            'events' => Event::with('category')->orderByDesc('tanggal')->orderByDesc('id')->get(),
        ]);
    }

    //baru
    public function create(): View
    {
        return view('kegiatan.create', ['categories' => Category::orderBy('nama')->get()]);
    }

    //baru
    public function store(Request $request): RedirectResponse
    {
        Event::create($this->validated($request));

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    //baru
    public function edit(Event $event): View
    {
        return view('kegiatan.edit', ['event' => $event, 'categories' => Category::orderBy('nama')->get()]);
    }

    //baru
    public function update(Request $request, Event $event): RedirectResponse
    {
        $event->update($this->validated($request));

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    //baru
    public function destroy(Event $event): RedirectResponse
    {
        //baru
        if ($event->registrations()->exists()) {
            return redirect()->route('kegiatan.index')->with('error', 'Kegiatan tidak dapat dihapus karena sudah memiliki pendaftar.');
        }

        $event->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    //baru
    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'tanggal' => ['required', 'date'],
            'waktu_mulai' => ['nullable', 'date_format:H:i'],
            'lokasi' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
