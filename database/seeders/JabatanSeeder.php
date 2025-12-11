<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Nama' => 'Staff Administrasi', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Staff Medis', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Staff Keperawatan', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Petugas Farmasi', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Petugas Laboratorium', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Perawat Pelaksana', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Radiografer', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Koordinator Unit', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Supervisor', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Kepala Ruangan', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Kepala Instalasi', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Kepala Bidang', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Kepala Divisi', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Manajer', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Asisten Manajer', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Kepala Departemen', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Ka. Sub Departemen', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Wakil Direktur', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Direktur RS', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Komite Medis', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
            ['Nama' => 'Ketua Komite', 'UserCreate' => 'system', 'UserUpdate' => null, 'UserDelete' => null],
        ];

        DB::table('master_jabatans')->insert($data);
    }
}
