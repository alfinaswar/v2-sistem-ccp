<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterPerusahaanSeeder extends Seeder
{
    public function run(): void
    {
        // master parameters

        // Master perusahaan untuk ABGROUP - RS Awal Bros Group
        DB::table('master_perusahaans')->insert([
            [
                'Kode' => 'ABG001',
                'Nama' => 'RS Awal Bros Sudirman',
                'NamaLengkap' => 'Rumah Sakit Awal Bros Sudirman',
                'Deskripsi' => 'RS Awal Bros Sudirman, pusat kesehatan modern dan unggulan di daerah Sudirman.',
                'Kategori' => 'ABGROUP',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'ABG002',
                'Nama' => 'RS Awal Bros Panam',
                'NamaLengkap' => 'Rumah Sakit Awal Bros Panam',
                'Deskripsi' => 'RS Awal Bros Panam melayani masyarakat wilayah Panam dan sekitarnya.',
                'Kategori' => 'ABGROUP',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'ABG003',
                'Nama' => 'RS Awal Bros Ahmad Yani',
                'NamaLengkap' => 'Rumah Sakit Awal Bros Ahmad Yani (A. Yani)',
                'Deskripsi' => 'RS Awal Bros Ahmad Yani terletak di kawasan strategis Ahmad Yani.',
                'Kategori' => 'ABGROUP',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'ABG004',
                'Nama' => 'RS Awal Bros Hangtuah',
                'NamaLengkap' => 'Rumah Sakit Awal Bros Hangtuah',
                'Deskripsi' => 'Rumah sakit yang menyediakan layanan kesehatan lengkap di Hangtuah.',
                'Kategori' => 'ABGROUP',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'ABG005',
                'Nama' => 'RS Awal Bros Dumai',
                'NamaLengkap' => 'Rumah Sakit Awal Bros Dumai',
                'Deskripsi' => 'Rumah sakit utama di Dumai, Riau, dengan fasilitas modern.',
                'Kategori' => 'ABGROUP',
                'Koneksi' => 'Dumai, Riau',
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'ABG006',
                'Nama' => 'RS Awal Bros Ujung Batu',
                'NamaLengkap' => 'Rumah Sakit Awal Bros Ujung Batu',
                'Deskripsi' => 'Pelayanan kesehatan terpercaya di daerah Ujung Batu.',
                'Kategori' => 'ABGROUP',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'ABG007',
                'Nama' => 'RS Awal Bros Bagan Batu',
                'NamaLengkap' => 'Rumah Sakit Awal Bros Bagan Batu',
                'Deskripsi' => 'Rumah sakit dengan pelayanan prima di Bagan Batu.',
                'Kategori' => 'ABGROUP',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'ABG008',
                'Nama' => 'RS Awal Bros Batam',
                'NamaLengkap' => 'Rumah Sakit Awal Bros Batam',
                'Deskripsi' => 'Rumah sakit terkemuka di Batam dengan fasilitas lengkap.',
                'Kategori' => 'ABGROUP',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'ABG009',
                'Nama' => 'RS Awal Bros Botania',
                'NamaLengkap' => 'Rumah Sakit Awal Bros Botania',
                'Deskripsi' => 'Layanan kesehatan untuk wilayah Botania dan sekitarnya.',
                'Kategori' => 'ABGROUP',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'CSC001',
                'Nama' => 'PT Langit Biru Sehat Sentosa',
                'NamaLengkap' => 'PT Langit Biru Sehat Sentosa',
                'Deskripsi' => 'Perusahaan penyedia layanan kesehatan dan konsultasi.',
                'Kategori' => 'CISCO',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'CSC002',
                'Nama' => 'PT Cahaya Perdana Nusantara',
                'NamaLengkap' => 'PT Cahaya Perdana Nusantara',
                'Deskripsi' => 'Perusahaan nasional bergerak di bidang kesehatan.',
                'Kategori' => 'CISCO',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'CSC003',
                'Nama' => 'PT Digital Indonesia Hebat',
                'NamaLengkap' => 'PT Digital Indonesia Hebat',
                'Deskripsi' => 'Fokus pada layanan digital dan inovasi kesehatan.',
                'Kategori' => 'CISCO',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'CSC004',
                'Nama' => 'PT Digital Kalibrasi Hebat',
                'NamaLengkap' => 'PT Digital Kalibrasi Hebat',
                'Deskripsi' => 'Spesialis kalibrasi alat-alat kesehatan secara digital.',
                'Kategori' => 'CISCO',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
            [
                'Kode' => 'CSC005',
                'Nama' => 'Awal Bros Training Center',
                'NamaLengkap' => 'Awal Bros Training Center',
                'Deskripsi' => 'Pusat pelatihan dan pengembangan SDM bidang kesehatan.',
                'Kategori' => 'CISCO',
                'Koneksi' => null,
                'UserCreate' => 'System',
                'created_at' => now(),
            ],
        ]);
    }
}
