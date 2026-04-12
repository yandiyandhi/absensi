<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\JenisIzin;
use App\Models\Kantor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::firstOrCreate(['name' => 'admin']);

        Departemen::create([
            'uuid' => Str::uuid(),
            'kode_departemen' => 'DEPT001',
            'nama_departemen' => 'IT',
        ]);

        Departemen::create([
            'uuid' => Str::uuid(),
            'kode_departemen' => 'DEPT002',
            'nama_departemen' => 'Finance',
        ]);

        Kantor::create([
            'uuid' => Str::uuid(),
            'kode_kantor' => 'KTR001',
            'nama_kantor' => 'Kantor Toha',
            'alamat_kantor' => 'Jl. M. Toha No. 266, Bandung 40243',
            'latitude' => '-6.951323706915621',
            'longitude' => '107.61025414190031'
        ]);

        Kantor::create([
            'uuid' => Str::uuid(),
            'kode_kantor' => 'KTR002',
            'nama_kantor' => 'Kantor Karapitan',
            'alamat_kantor' => 'Jl. Karapitan No.16 B, Bandung 40261',
            'latitude' => '-6.924496020783163',
            'longitude' => '107.61719706152526'
        ]);

        Jabatan::create([
            'uuid' => Str::uuid(),
            'departemen_id' => '1',
            'kode_jabatan' => 'JBT001',
            'nama_jabatan' => 'IT Support',
        ]);

        JenisIzin::create([
            'nama_izin' => 'Sakit',
        ]);

        JenisIzin::create([
            'nama_izin' => 'Masuk Siang',
        ]);

        $user = User::create([
            'uuid' => Str::uuid(),
            'kantor_id' => '1',
            'jabatan_id' => '1',
            'username' => 'admin',
            'nik' => '123456789',
            'name' => 'Administrator',
            'alamat' => 'Bandung',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123*'),
        ]);

        $user->syncRoles('admin');

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            // departemen
            'departemen.view',
            'departemen.create',
            'departemen.update',
            'departemen.delete',

            // jabatan
            'jabatan.view',
            'jabatan.create',
            'jabatan.update',
            'jabatan.delete',

            // kantor
            'kantor.view',
            'kantor.create',
            'kantor.update',
            'kantor.delete',

            // jenis izin
            'jenisizin.view',
            'jenisizin.create',
            'jenisizin.update',
            'jenisizin.delete',

            // user
            'user.view',
            'user.create',
            'user.update',
            'user.role',
            'user.password',

            // cuti
            'listcuti.view',
            'approval.cuti',

            // izin
            'listizin.view',
            'approval.izin',

            // role
            'role.view',
            'role.create',
            'role.edit',
            'role.permission',

            // permission
            'permission.view',
            'permission.create',
            'permission.update',
            'permission.delete',

            // acara
            'acara.view',
            'acara.create',
            'acara.edit',
            'acara.detail',
            'acara.update',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
