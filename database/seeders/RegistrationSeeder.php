<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $userId = DB::table('users')->value('id');
        $eventId = DB::table('events')->value('id');

        if (! $userId || ! $eventId) {
            return;
        }

        $exists = DB::table('registrations')
            ->where('user_id', $userId)
            ->where('event_id', $eventId)
            ->exists();

        if (! $exists) {
            DB::table('registrations')->insert([
                'user_id' => $userId,
                'event_id' => $eventId,
                'tanggal_daftar' => now(),
            ]);
        }
    }
}