<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 2,
                'role_id' => 1,
            ),
            2 => 
            array (
                'permission_id' => 3,
                'role_id' => 1,
            ),
            3 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            4 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 1,
                'role_id' => 3,
            ),
            6 => 
            array (
                'permission_id' => 3,
                'role_id' => 3,
            ),
            7 => 
            array (
                'permission_id' => 5,
                'role_id' => 3,
            ),
            8 => 
            array (
                'permission_id' => 1,
                'role_id' => 4,
            ),
            9 => 
            array (
                'permission_id' => 5,
                'role_id' => 4,
            ),
            10 => 
            array (
                'permission_id' => 7,
                'role_id' => 1,
            ),
            11 => 
            array (
                'permission_id' => 5,
                'role_id' => 1,
            ),
            12 => 
            array (
                'permission_id' => 6,
                'role_id' => 6,
            ),
            
        ));
        
        
    }
}