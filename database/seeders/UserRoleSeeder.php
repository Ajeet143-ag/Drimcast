<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRoles;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $all_role_array = ['customer','employee','subadmin'];

        foreach ($all_role_array as $key=>$value) {
            $insertrole = new UserRoles();
            $insertrole->role_name = $value;
            $insertrole->save();
        }
    }
}
