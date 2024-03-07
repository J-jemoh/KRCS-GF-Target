<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Read Admin Panel',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 13:39:58',
                'updated_at' => '2024-01-26 13:39:58',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Manage Users',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 13:40:08',
                'updated_at' => '2024-01-26 13:40:08',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Read C7 Coverage',
                'guard_name' => 'web',
                'created_at' => '2024-01-26 13:40:19',
                'updated_at' => '2024-01-26 13:40:19',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Read Analytics Panel',
                'guard_name' => 'web',
                'created_at' => '2024-01-27 12:22:22',
                'updated_at' => '2024-01-27 12:22:22',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Upload Targets',
                'guard_name' => 'web',
                'created_at' => '2024-01-27 12:22:39',
                'updated_at' => '2024-01-27 12:22:39',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Public Access',
                'guard_name' => 'web',
                'created_at' => '2024-01-27 12:42:12',
                'updated_at' => '2024-01-27 12:43:08',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Manage Settings',
                'guard_name' => 'web',
                'created_at' => '2021-03-25 16:33:14',
                'updated_at' => '2021-03-25 16:33:14',
            ),
   
        ));
        
        
    }
}