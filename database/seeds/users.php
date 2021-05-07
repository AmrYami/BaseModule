<?php

namespace Database\Seeders;

use Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'amryami@BaseModule.com',
                'password'=> Hash::make('123456789'),
                'type' => 'crm admin',
                'code' => uniqid(),
                'status' => 1
            ]
        ];
        User::insert($data);
    }
}
