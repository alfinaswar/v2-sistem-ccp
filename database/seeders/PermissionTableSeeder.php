<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'departemen-list',
            'departemen-create',
            'departemen-edit',
            'departemen-delete',
            'perusahaan-list',
            'perusahaan-create',
            'perusahaan-edit',
            'perusahaan-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'barang-list',
            'barang-create',
            'barang-edit',
            'barang-delete',
            'satuan-barang-list',
            'satuan-barang-create',
            'satuan-barang-edit',
            'satuan-barang-delete',
            'master-merk-list',
            'master-merk-create',
            'master-merk-edit',
            'master-merk-delete',
            'vendor-list',
            'vendor-create',
            'vendor-edit',
            'vendor-delete',
            'pengajuan-pembelian-list',
            'pengajuan-pembelian-create',
            'pengajuan-pembelian-edit',
            'pengajuan-pembelian-delete',
            'permintaan-list',
            'permintaan-create',
            'permintaan-edit',
            'permintaan-delete',
            'approve-kepala-divisi',
            'approve-kepala-divisi-penunjang',
            'approve-direktur',
            'approve-logistik',
            'approve-smi',
            'approve-penilai1',
            'approve-penilai2',
            'approve-penilai3',
            'approve-penilai4',
            'approve-penilai5',
            'approve-ccp',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
