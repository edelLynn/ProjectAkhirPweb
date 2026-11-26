<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Seeder;

//baru
class CategoryEventSeeder extends Seeder
{
    //baru
    public function run(): void
    {
        $seminar = Category::updateOrCreate(['nama' => 'Seminar'], ['deskripsi' => 'Seminar dan kuliah umum.']);
        $pelatihan = Category::updateOrCreate(['nama' => 'Pelatihan'], ['deskripsi' => 'Pelatihan keterampilan mahasiswa.']);

        Event::updateOrCreate(
            ['judul' => 'Seminar Teknologi'],
            ['category_id' => $seminar->id, 'deskripsi' => 'Seminar teknologi untuk mahasiswa.', 'tanggal' => '2026-12-01', 'waktu_mulai' => '09:00', 'lokasi' => 'Aula Kampus']
        );
        Event::updateOrCreate(
            ['judul' => 'Pelatihan Laravel'],
            ['category_id' => $pelatihan->id, 'deskripsi' => 'Pelatihan dasar Laravel.', 'tanggal' => '2026-12-10', 'waktu_mulai' => '08:00', 'lokasi' => 'Lab Komputer']
        );
    }
}
