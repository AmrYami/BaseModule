<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TopMGTPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Top MGT permission_group
        DB::table('permissions')->insert([
            [
                "name"=> "dashboard",
                "display_name" => "Dashboard",
                "description" => "Who can access general dashboard",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "list-users-role",
                "display_name" => "Force List User's Role",
                "description" => "Who can access the roles permissions list",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "create-users-role",
                "display_name" => "Create User's Role",
                "description" => "Who can add new roles to the system and determine this role permissions",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "edit-users-role",
                "display_name" => "Edit User's Role",
                "description" => "Who can edit existing role",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "delete-users-role",
                "display_name" => "Delete User's Role",
                "description" => "Who can delete roles on the system",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "delete-users",
                "display_name" => "Delete User's Role",
                "description" => "Who can delete user on the system",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "list-users",
                "display_name" => "Force List Users",
                "description" => "Who can access the users list",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "create-users",
                "display_name" => "Create Users",
                "description" => "Who can add new users to the system and determine his Role",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "edit-users",
                "display_name" => "Edit User",
                "description" => "Who can edit data of exist user of internal team",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "edit-my-profile",
                "display_name" => "Edit User Profile",
                "description" => "Who can edit data of exist user of internal team",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "block-users",
                "display_name" => "Block Users",
                "description" => "Who can prevent users to log in CRM with saving their leads",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],


            [
                "name"=> "users-logs",
                "display_name" => "Users Logs",
                "description" => "Who can access the users logs",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "restore-from-trash",
                "display_name" => "Restore From Trash",
                "description" => "Who can Restore from Trash",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

            [
                "name"=> "permanent-delete-from-trash",
                "display_name" => "Permenant Delete From Trash",
                "description" => "Who can permanent delete from trash",
                "permission_group"=>"top-mgt",
                "guard_name" => "web",
                "created_at" => Carbon::now()->toDateTimeString(),
            ],

        ]);


    }
}
