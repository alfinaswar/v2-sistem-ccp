<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenSeeder extends Seeder
{
    public function run(): void
    {
        $departemen = [
            // --- Direksi & Manajemen ---
            ['DEP001', 1, 'Direksi'],
            ['DEP002', 2, 'Wakil Direktur'],
            ['DEP003', 3, 'Tata Usaha'],
            ['DEP004', 4, 'Sekretariat Rumah Sakit'],
            // --- Administrasi & Penunjang Non Medis ---
            ['DEP005', 5, 'Keuangan'],
            ['DEP006', 6, 'Akuntansi'],
            ['DEP007', 7, 'Billing'],
            ['DEP008', 8, 'SDM / HRD'],
            ['DEP009', 9, 'Humas & Marketing'],
            ['DEP010', 10, 'Purchasing / Pembelian'],
            ['DEP011', 11, 'Logistik'],
            ['DEP012', 12, 'Gudang Umum'],
            ['DEP013', 13, 'IT / SIMRS'],
            ['DEP014', 14, 'Pengadaan Barang & Jasa'],
            ['DEP015', 15, 'Pemeliharaan Sarana & Prasarana'],
            ['DEP016', 16, 'Rumah Tangga (Cleaning Service)'],
            ['DEP017', 17, 'Laundry'],
            ['DEP018', 18, 'Keamanan / Security'],
            ['DEP019', 19, 'Transportasi / Driver'],
            ['DEP020', 20, 'Kantin Rumah Sakit'],
            // --- Pelayanan Inti ---
            ['DEP021', 21, 'Instalasi Gawat Darurat (IGD)'],
            ['DEP022', 22, 'Instalasi Rawat Jalan'],
            ['DEP023', 23, 'Instalasi Rawat Inap'],
            ['DEP024', 24, 'Ruang ICU / HCU'],
            ['DEP025', 25, 'NICU / PICU'],
            ['DEP026', 26, 'Perinatologi'],
            ['DEP027', 27, 'VK (Ruang Bersalin)'],
            ['DEP028', 28, 'Kamar Operasi (OK)'],
            ['DEP029', 29, 'Rehabilitasi Medik'],
            ['DEP030', 30, 'Hemodialisa'],
            ['DEP031', 31, 'Kamar Jenazah / Forensik'],
            // --- Penunjang Medis ---
            ['DEP032', 32, 'Laboratorium'],
            ['DEP033', 33, 'Radiologi'],
            ['DEP034', 34, 'Farmasi'],
            ['DEP035', 35, 'CSSD'],
            ['DEP036', 36, 'Gizi'],
            ['DEP037', 37, 'Rekam Medis'],
            ['DEP038', 38, 'Bank Darah'],
            ['DEP039', 39, 'Fisioterapi'],
            ['DEP040', 40, 'Klinik MCU'],
            // --- Kelompok Staf Medis (KSM) Spesialis ---
            ['DEP041', 41, 'KSM Penyakit Dalam'],
            ['DEP042', 42, 'KSM Bedah'],
            ['DEP043', 43, 'KSM Anak'],
            ['DEP044', 44, 'KSM Kebidanan & Kandungan'],
            ['DEP045', 45, 'KSM Saraf'],
            ['DEP046', 46, 'KSM Jiwa'],
            ['DEP047', 47, 'KSM Anestesi & Terapi Intensif'],
            ['DEP048', 48, 'KSM THT'],
            ['DEP049', 49, 'KSM Mata'],
            ['DEP050', 50, 'KSM Kulit & Kelamin'],
            ['DEP051', 51, 'KSM Orthopedi'],
            ['DEP052', 52, 'KSM Urologi'],
            ['DEP053', 53, 'KSM Paru'],
            ['DEP054', 54, 'KSM Rehabilitasi Medik'],
            ['DEP055', 55, 'KSM Radiologi'],
            ['DEP056', 56, 'KSM Patologi Klinik'],
            ['DEP057', 57, 'KSM Patologi Anatomi'],
            ['DEP058', 58, 'KSM Gigi & Mulut'],
            // --- Ruangan & Unit Tambahan ---
            ['DEP059', 59, 'Ruang Isolasi'],
            ['DEP060', 60, 'Ruang Bayi'],
            ['DEP061', 61, 'Ruang Intermediate Care'],
            ['DEP062', 62, 'Ruang High Care Unit (HCU)'],
            ['DEP063', 63, 'Ruang Rehabilitasi'],
            ['DEP064', 64, 'Ruang Rawat Eksekutif'],
            ['DEP065', 65, 'Ruang Farmasi Rawat Jalan'],
            ['DEP066', 66, 'Ruang Farmasi Rawat Inap'],
            ['DEP067', 67, 'Ruang Transfusi Darah'],
            ['DEP068', 68, 'Unit Pengendalian Infeksi (PPI)'],
            ['DEP069', 69, 'Unit K3 Rumah Sakit'],
            ['DEP070', 70, 'Unit Mutu & Akreditasi'],
        ];

        foreach ($departemen as $d) {
            DB::table('master_departemens')->insert([
                'KodeDepartemen' => $d[0],
                'IdDepartemen' => $d[1],
                'Nama' => $d[2],
                'UserCreate' => 'Administrator',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
