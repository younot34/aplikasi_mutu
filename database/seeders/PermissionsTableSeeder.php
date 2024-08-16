<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // permission for farmasis
        Permission::create(['name' => 'farmasis.index']);
        Permission::create(['name' => 'farmasis.create']);
        Permission::create(['name' => 'farmasis.edit']);
        Permission::create(['name' => 'farmasis.delete']);
        Permission::create(['name' => 'farmasis.laporan-bulanan']);

        // permission for list obat
        Permission::create(['name' => 'list.index']);
        Permission::create(['name' => 'list.create']);
        Permission::create(['name' => 'list.edit']);
        Permission::create(['name' => 'list.delete']);

        //permission for imprs
        Permission::create(['name' => 'imprs.index']);
        Permission::create(['name' => 'imprs.create']);
        Permission::create(['name' => 'imprs.edit']);
        Permission::create(['name' => 'imprs.delete']);
        Permission::create(['name' => 'imprs.export']);

        //permission for oks
        Permission::create(['name' => 'oks.index']);
        Permission::create(['name' => 'oks.create']);
        Permission::create(['name' => 'oks.edit']);
        Permission::create(['name' => 'oks.delete']);
        Permission::create(['name' => 'oks.review']);
        Permission::create(['name' => 'oks.review_bulanan_ok']);

        //permission for ppi
        Permission::create(['name' => 'ppis.index']);
        Permission::create(['name' => 'ppis.create']);
        Permission::create(['name' => 'ppis.edit']);
        Permission::create(['name' => 'ppis.delete']);

         //permission for ris
         Permission::create(['name' => 'ris.index']);
         Permission::create(['name' => 'ris.create']);
         Permission::create(['name' => 'ris.edit']);
         Permission::create(['name' => 'ris.delete']);

         //permission for visites
         Permission::create(['name' => 'visites.index']);
         Permission::create(['name' => 'visites.create']);
         Permission::create(['name' => 'visites.edit']);
         Permission::create(['name' => 'visites.delete']);

         //permission for clinicals
         Permission::create(['name' => 'clinicals.index']);
         Permission::create(['name' => 'clinicals.create']);
         Permission::create(['name' => 'clinicals.edit']);
         Permission::create(['name' => 'clinicals.delete']);

         //permission for jatuhs
         Permission::create(['name' => 'jatuhs.index']);
         Permission::create(['name' => 'jatuhs.create']);
         Permission::create(['name' => 'jatuhs.edit']);
         Permission::create(['name' => 'jatuhs.delete']);

         //permission for apds
         Permission::create(['name' => 'apds.index']);
         Permission::create(['name' => 'apds.create']);
         Permission::create(['name' => 'apds.edit']);
         Permission::create(['name' => 'apds.delete']);

        //permission for roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index']);

        //permission for users
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);
    }
}
