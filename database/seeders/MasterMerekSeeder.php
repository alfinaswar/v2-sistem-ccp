<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterMerekSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_merks')->insert([
            // ===== ALAT MONITORING & DIAGNOSTIK =====
            ['Nama' => 'Omron', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Mindray', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'GE Healthcare', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Philips Healthcare', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Siemens Healthineers', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Contec', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Beurer', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Microlife', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Welch Allyn', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Yuwell', 'UserCreate' => 'System', 'UserUpdate' => 'System'],

            // ===== ALAT TERAPI & PERAWATAN =====
            ['Nama' => 'B. Braun', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Terumo', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Nipro', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => '3M Health Care', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Smiths Medical', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Cardinal Health', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Covidien', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Hartmann', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Ansell', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Kimberly-Clark', 'UserCreate' => 'System', 'UserUpdate' => 'System'],

            // ===== PERLENGKAPAN RUMAH SAKIT =====
            ['Nama' => 'Atom Medical', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Dräger', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Paramount Bed', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Hill-Rom', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Mindray Patient Monitor', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Sartorius', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Schiller', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Spencer', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Welmed', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Vitalograph', 'UserCreate' => 'System', 'UserUpdate' => 'System'],

            // ===== ALAT STERILISASI & INSTRUMEN =====
            ['Nama' => 'Tuttnauer', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Sanyo', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Medivator', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Belimed', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Getinge', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Astell', 'UserCreate' => 'System', 'UserUpdate' => 'System'],

            // ===== LABORATORIUM =====
            ['Nama' => 'Eppendorf', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Greiner Bio-One', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Thermo Fisher', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Bio-Rad', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Nalgene', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Sakura Finetek', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Hitachi', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Sysmex', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Abbott Diagnostics', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'BioMérieux', 'UserCreate' => 'System', 'UserUpdate' => 'System'],

            // ===== ALAT REHABILITASI & FISIOTERAPI =====
            ['Nama' => 'Chattanooga', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'OG Wellness', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Enraf-Nonius', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Zepter', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Ibramed', 'UserCreate' => 'System', 'UserUpdate' => 'System'],

            // ===== LAINNYA =====
            ['Nama' => 'OneMed', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Onemed Instruments', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Dr. Care', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Vygon', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'Fresenius', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'ResMed', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
            ['Nama' => 'CareFusion', 'UserCreate' => 'System', 'UserUpdate' => 'System'],
        ]);
    }
}
