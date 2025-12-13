<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus cache role dan permission untuk menghindari masalah
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Membuat role dengan firstOrCreate
        // Jika role sudah ada, akan digunakan role yang sudah ada.
        // Jika belum ada, akan dibuat yang baru.
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleMahasiswa = Role::firstOrCreate(['name' => 'Mahasiswa']);

        // Membuat user admin dan memberikan role Admin
        // Gunakan firstOrCreate untuk user juga agar tidak duplikat
        $admin = User::firstOrCreate(
            ['email' => 'admin@stie.com'],
            [
                'name' => 'Admin STIE',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole($roleAdmin);
    }
}