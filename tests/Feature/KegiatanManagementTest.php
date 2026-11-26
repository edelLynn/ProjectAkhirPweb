<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KegiatanManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_categories_and_events(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->post(route('kategori.store'), ['nama' => 'Seminar', 'deskripsi' => 'Kegiatan seminar'])
            ->assertRedirect(route('kategori.index'));

        $category = Category::where('nama', 'Seminar')->firstOrFail();

        $this->actingAs($admin)
            ->post(route('kegiatan.store'), [
                'category_id' => $category->id,
                'judul' => 'Seminar Laravel',
                'deskripsi' => 'Belajar Laravel',
                'tanggal' => '2026-12-01',
                'waktu_mulai' => '09:00',
                'lokasi' => 'Aula',
            ])
            ->assertRedirect(route('kegiatan.index'));

        $this->assertDatabaseHas('events', ['judul' => 'Seminar Laravel']);
    }

    public function test_category_with_events_cannot_be_deleted(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => 'password',
            'role' => 'admin',
        ]);
        $category = Category::create(['nama' => 'Seminar']);
        Event::create(['category_id' => $category->id, 'judul' => 'Seminar Laravel', 'tanggal' => '2026-12-01']);

        $this->actingAs($admin)
            ->delete(route('kategori.destroy', $category))
            ->assertRedirect(route('kategori.index'));

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }
}
