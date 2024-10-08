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
        //permission for rmrs
        Permission::create(['name' => 'rmrs.index']);
        Permission::create(['name' => 'rmrs.create']);
        Permission::create(['name' => 'rmrs.edit']);
        Permission::create(['name' => 'rmrs.delete']);
        Permission::create(['name' => 'rmrs.review']);
        Permission::create(['name' => 'rmrs.review_bulanan_rm']);

        //permission for ppi
        Permission::create(['name' => 'ppis.index']);
        Permission::create(['name' => 'ppis.create']);
        Permission::create(['name' => 'ppis.edit']);
        Permission::create(['name' => 'ppis.delete']);
        Permission::create(['name' => 'ppis.export_ppi']);

         //permission for ris
         Permission::create(['name' => 'ris.index']);
         Permission::create(['name' => 'ris.create']);
         Permission::create(['name' => 'ris.edit']);
         Permission::create(['name' => 'ris.delete']);
         Permission::create(['name' => 'ris.export_ri']);

         //permission for visites
         Permission::create(['name' => 'visites.index']);
         Permission::create(['name' => 'visites.create']);
         Permission::create(['name' => 'visites.edit']);
         Permission::create(['name' => 'visites.delete']);
         Permission::create(['name' => 'visites.export_v']);

         //permission for clinicals
         Permission::create(['name' => 'clinicals.index']);
         Permission::create(['name' => 'clinicals.create']);
         Permission::create(['name' => 'clinicals.edit']);
         Permission::create(['name' => 'clinicals.delete']);
         Permission::create(['name' => 'clinicals.export_c']);

         //permission for jatuhs
         Permission::create(['name' => 'jatuhs.index']);
         Permission::create(['name' => 'jatuhs.create']);
         Permission::create(['name' => 'jatuhs.edit']);
         Permission::create(['name' => 'jatuhs.delete']);
         Permission::create(['name' => 'jatuhs.export_j']);

         //permission for apds
         Permission::create(['name' => 'apds.index']);
         Permission::create(['name' => 'apds.create']);
         Permission::create(['name' => 'apds.edit']);
         Permission::create(['name' => 'apds.delete']);
         Permission::create(['name' => 'apds.export_apd']);

         //permission for ewss
         Permission::create(['name' => 'ewss.index']);
         Permission::create(['name' => 'ewss.create']);
         Permission::create(['name' => 'ewss.edit']);
         Permission::create(['name' => 'ewss.delete']);
         Permission::create(['name' => 'ewss.export_e']);

         //permission for inters
         Permission::create(['name' => 'inters.index']);
         Permission::create(['name' => 'inters.create']);
         Permission::create(['name' => 'inters.edit']);
         Permission::create(['name' => 'inters.delete']);
         Permission::create(['name' => 'inters.export_in']);

         //permission for dpjps
         Permission::create(['name' => 'dpjps.index']);
         Permission::create(['name' => 'dpjps.create']);
         Permission::create(['name' => 'dpjps.edit']);
         Permission::create(['name' => 'dpjps.delete']);
         Permission::create(['name' => 'dpjps.export_dp']);

         //permission for rajals
         Permission::create(['name' => 'rajals.index']);
         Permission::create(['name' => 'rajals.create']);
         Permission::create(['name' => 'rajals.edit']);
         Permission::create(['name' => 'rajals.delete']);
         Permission::create(['name' => 'rajals.export_ra']);

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

        //asess
        Permission::create(['name' => 'asess.index']);
        Permission::create(['name' => 'asess.create']);
        Permission::create(['name' => 'asess.edit']);
        Permission::create(['name' => 'asess.delete']);
        Permission::create(['name' => 'asess.export_as']);

        //rmris
        Permission::create(['name' => 'rmris.index']);
        Permission::create(['name' => 'rmris.create']);
        Permission::create(['name' => 'rmris.edit']);
        Permission::create(['name' => 'rmris.delete']);
        Permission::create(['name' => 'rmris.review']);
        Permission::create(['name' => 'rmris.review_bulanan_rmi']);
    }
}
