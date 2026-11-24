<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1 akun admin
        User::updateOrCreate(
            ['email' => 'admin@eventra.test'],
            [
                'name'     => 'Admin Eventra',
                'password' => 'password',
                'role'     => 'admin',
            ]
        );

        // Mahasiswa contoh (password semuanya: password)
        $mahasiswa = [
            ['Aulia Rahma',    '252410103001', 'Informatika'],
            ['Bima Saputra',   '252410103002', 'Informatika'],
            ['Citra Lestari',  '252410103003', 'Sistem Informasi'],
            ['Dimas Pratama',  '252410103005', 'Sistem Informasi'],
            ['Eka Wulandari',  '252410103006', 'Teknologi Informasi'],
            ['Farhan Hidayat', '252410103007', 'Informatika'],
            ['Gita Anggraini', '252410103008', 'Teknologi Informasi'],
            ['Hendra Wijaya',  '252410103009', 'Informatika'],
            ['Intan Permata',  '252410103010', 'Sistem Informasi'],
            ['Joko Santoso',   '252410103011', 'Informatika'],
            ['Kirana Putri',   '252410103012', 'Teknologi Informasi'],
            ['Lukman Hakim',   '252410103013', 'Informatika'],
        ];

        foreach ($mahasiswa as $i => [$nama, $nim, $prodi]) {
            User::updateOrCreate(
                ['nim' => $nim],
                [
                    'name'     => $nama,
                    'email'    => 'mhs' . ($i + 1) . '@eventra.test',
                    'password' => 'password',
                    'role'     => 'mahasiswa',
                    'prodi'    => $prodi,
                    'no_hp'    => '0812345678' . str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT),
                ]
            );
        }
    }
}
