<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Users\Models\User;

class RolesTableSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin Role
        $role = Role::create(['name' => 'CRM Admin','guard_name'=>'web']);
        $role->givePermissionTo([Permission::all()]);
        $admin= User::findOrFail(1);

        // $test1=\Users\Models\User::findOrFail(2);
        // $test2=\Users\Models\User::findOrFail(3);
        // $test3=\Users\Models\User::findOrFail(4);
        $admin->assignRole('CRM Admin');
        // $test1->assignRole('CRM Admin');
        // $test2->assignRole('CRM Admin');
        // $test3->assignRole('CRM Admin');
        Role::create(['name' => 'admin','guard_name'=>'web']);
    }
}
