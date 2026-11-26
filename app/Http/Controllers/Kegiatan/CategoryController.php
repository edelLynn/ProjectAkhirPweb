<?php

namespace App\Http\Controllers\Kegiatan;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

//baru
class CategoryController extends Controller
{
    //baru
    public function index(): View
    {
        return view('kegiatan.kategori.index', [
            'categories' => Category::withCount('events')->orderBy('nama')->get(),
        ]);
    }

    //baru
    public function create(): View
    {
        return view('kegiatan.kategori.create');
    }

    //baru
    public function store(Request $request): RedirectResponse
    {
        Category::create($this->validated($request));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    //baru
    public function edit(Category $category): View
    {
        return view('kegiatan.kategori.edit', compact('category'));
    }

    //baru
    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($this->validated($request, $category));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    //baru
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->events()->exists()) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak dapat dihapus karena masih digunakan kegiatan.');
        }

        $category->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    //baru
    private function validated(Request $request, ?Category $category = null): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255', Rule::unique('categories', 'nama')->ignore($category)],
            'deskripsi' => ['nullable', 'string'],
        ]);
    }
}
