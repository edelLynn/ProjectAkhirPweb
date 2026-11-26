<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MahasiswaRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_mahasiswa_registration_uses_the_authenticated_account(): void
    {
        $mahasiswa = User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@example.test',
            'password' => 'password',
            'role' => 'mahasiswa',
        ]);
        $otherUser = User::create([
            'name' => 'Other User',
            'email' => 'other@example.test',
            'password' => 'password',
            'role' => 'mahasiswa',
        ]);
        $event = Event::create([
            'judul' => 'Seminar Laravel',
            'tanggal' => '2026-12-01',
        ]);

        $this->actingAs($mahasiswa)
            ->get(route('pendaftaran.index'))
            ->assertOk()
            ->assertSee('mahasiswa@example.test')
            ->assertDontSee('other@example.test');

        $this->actingAs($mahasiswa)
            ->post(route('pendaftaran.store'), [
                'event_id' => $event->id,
                'user_id' => $otherUser->id,
            ])
            ->assertRedirect(route('pendaftaran.index'));

        $this->assertDatabaseHas('registrations', [
            'user_id' => $mahasiswa->id,
            'event_id' => $event->id,
        ]);
        $this->assertDatabaseMissing('registrations', [
            'user_id' => $otherUser->id,
            'event_id' => $event->id,
        ]);
    }

    public function test_admin_cannot_access_mahasiswa_registration(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->actingAs($admin)
            ->get(route('pendaftaran.index'))
            ->assertForbidden();
    }
}
