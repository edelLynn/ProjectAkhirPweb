<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Urutan penting: tabel yang dirujuk harus terisi lebih dulu.
    // Hapus tanda // pada seeder milik anggota lain setelah file-nya ada.
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            // CategoryEventSeeder::class,
            // RegistrationSeeder::class,
            // AttendanceSeeder::class,
        ]);
    }
}
