<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'jenjang-create','jenjang-edit','jenjang-delete','kelas-create','kelas-edit','kelas-delete','kelas-list','role-list','siswa-list','siswa-create','siswa-edit','siswa-delete','tingkat-list','tingkat-create','tingkat-edit','tingkat-delete','user-list','user-create','user-edit','user-delete'
          ];

        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);

       }
    }
}
