<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create([
            'name' => 'admin'
        ]);

        $role2 = Role::create([
            'name' => 'petugas1'
        ]);

        $role3 = Role::create([
            'name' => 'petugas2'
        ]);

        $role4 = Role::create([
            'name' => 'petugas3'
        ]);

        $role5 = Role::create([
            'name' => 'petugas4'
        ]);

        $role6 = Role::create([
            'name' => 'petugas5'
        ]);

        $role7 = Role::create([
            'name' => 'petugas6'
        ]);

        $role8 = Role::create([
            'name' => 'petugas7'
        ]);

        $role9 = Role::create([
            'name' => 'direktur'
        ]);

        $role10 = Role::create([
            'name' => 'karyawan'
        ]);

    }
}