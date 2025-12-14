<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterFormSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('master_forms')->insert([
            [
                'id' => 1,
                'Nama' => 'HTA',
                'Parameter' => json_encode([
                    '1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
                    '11', '12', '13'
                ]),
                'UserCreate' => 'Administrator',
                'UserUpdate' => null,
                'UserDelete' => null,
                'deleted_at' => null,
                'created_at' => Carbon::parse('2025-12-10 07:35:34'),
                'updated_at' => Carbon::parse('2025-12-10 07:35:34'),
            ],
            [
                'id' => 2,
                'Nama' => 'GPA',
                'Parameter' => json_encode([
                    '1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
                    '11', '12', '13'
                ]),
                'UserCreate' => 'Administrator',
                'UserUpdate' => null,
                'UserDelete' => null,
                'deleted_at' => null,
                'created_at' => Carbon::parse('2025-12-10 07:35:41'),
                'updated_at' => Carbon::parse('2025-12-10 07:35:41'),
            ]
        ]);
    }
}
